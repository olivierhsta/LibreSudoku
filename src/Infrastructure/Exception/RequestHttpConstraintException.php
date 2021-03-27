<?php

namespace App\Infrastructure\Exception;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class RequestHttpConstraintException extends BadRequestHttpException
{
    /**
     * @var ConstraintViolationListInterface
     */
    private $constraintViolationList;

    public function __construct(ConstraintViolationListInterface $constraintViolationList)
    {
        $this->constraintViolationList = $constraintViolationList;

        $messages = [];
        foreach ($this->constraintViolations() as $constraintViolation) {
            $messages[] = sprintf(
                '%s : %s',
                $constraintViolation->getMessage(),
                $constraintViolation->getPropertyPath()
            );
        }
        parent::__construct(implode($messages, '\n'));
    }

    /**
     * @return iterable<ConstraintViolation>
     */
    public function constraintViolations(): iterable
    {
        for($i = 0; $i < count($this->constraintViolationList); $i++) {
            yield $this->constraintViolationList->get($i);
        }
    }
}