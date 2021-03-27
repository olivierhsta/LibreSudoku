<?php

namespace App\Infrastructure\Symfony;

use App\Infrastructure\Exception\RequestHttpConstraintException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Http\Request\RequestDto;
use function Safe\sprintf;

class RequestDtoResolver implements ArgumentValueResolverInterface
{
    private $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function supports(Request $request, ArgumentMetadata $argument)
    {
        $reflection = new \ReflectionClass($argument->getType());
        if ($reflection->isSubclassOf(RequestDto::class)) {
            return true;
        }

        return false;
    }

    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        // creating new instance of custom request DTO
        $class = $argument->getType();
        $dto = new $class($request);

        $errors = $this->validator->validate($dto);

        if ($dto->jsonData() !== null) {
            $publicVars = (new class {
                function publicVars(RequestDto $object) {
                    return get_object_vars($object);
                }
            })->publicVars($dto);

            foreach (array_diff(array_keys($dto->jsonData()), array_keys($publicVars)) as $invalidAttribute) {
                $errors->add(new ConstraintViolation(
                    sprintf('Unexpected attribute : %s', $invalidAttribute),
                    sprintf('Unexpected attribute : %s', $invalidAttribute),
                    [$invalidAttribute],
                    get_class($dto),
                    $invalidAttribute,
                    $dto->jsonData()[$invalidAttribute]
                ));
            }
        }

        if (count($errors) > 0) {
            throw new RequestHttpConstraintException($errors);
        }
        yield $dto;
    }
}
