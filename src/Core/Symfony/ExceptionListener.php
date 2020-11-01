<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use DomainException;
use Throwable;
use App\Http\HttpExceptionMapper;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        $request   = $event->getRequest();

        if ($exception instanceof DomainException) {
            $response = $this->createApiResponse($exception);
            $event->setResponse($response);
        }
    }

    private function createApiResponse(Throwable $exception): JsonResponse
    {
        $statusCode = HttpExceptionMapper::fromClassName(get_class($exception));
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
