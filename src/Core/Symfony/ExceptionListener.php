<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        $request   = $event->getRequest();

        $response = $this->createApiResponse($exception);
        $event->setResponse($response);
    }

    private function createApiResponse(Throwable $exception): JsonResponse
    {
        $statusCode = $exception instanceof HttpExceptionInterface ? $exception->getStatusCode() : JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
        $file = $exception->getTrace()[0] ? $exception->getTrace()[0]["class"] ?? null : null;

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
