<?php

namespace App\EventListener;

use App\Infrastructure\Exception\RequestHttpConstraintException;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Throwable;
use App\Http\HttpExceptionMapper;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        $response = $this->createApiResponse($exception);
        $event->setResponse($response);
    }

    private function createApiResponse(Throwable $exception): JsonResponse
    {
        $statusCode = HttpExceptionMapper::fromClassName(get_class($exception));
        $file = $exception->getTrace()[0] ? $exception->getTrace()[0]["class"] ?? null : null;

        if ($exception instanceof RequestHttpConstraintException) {
            $violations = [];
            foreach ($exception->constraintViolations() as $constraintViolation) {
                $violations[] = [
                    "property" => $constraintViolation->getPropertyPath(),
                    "message" => $constraintViolation->getMessage(),
                    "invalidValue" => $constraintViolation->getInvalidValue()
                ];
            }

            return new JsonResponse(
                [
                    'exception' => get_class($exception),
                    'violations' => $violations,
                    'description' => $exception->getMessage(),
                    'file' => $file . ':' . $exception->getLine()
                ],
                $statusCode
            );
        }

        return new JsonResponse(
            [
                'exception' => get_class($exception),
                'description' => $exception->getMessage(),
                'file' => $file . ':' . $exception->getLine()
            ],
            $statusCode
        );
    }
}
