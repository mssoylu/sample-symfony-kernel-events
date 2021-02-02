<?php
// src/EventListener/ExceptionListener.php
namespace App\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        // Bir nesne exception gonderirse yakalanir
        $exception = $event->getThrowable();
        $message = sprintf(
            'Mesaj soyle oluyor: %s hata kodu boyle: %s',
            $exception->getMessage(),
            $exception->getCode()
        );

        // Bu exception hatasini daha duzgun gostermek icin response nesnesi duzenlenir
        $response = new Response();
        $response->setContent($message);

        // HttpExceptionInterface icin status kod aynen tutulur
        // header bilgilerinde oldugu gibi yer alir
        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
        } else {
            // Bu hata baska bir sekilde olusmussa sunucu hatasi yani 500 olarak verilir
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // response duzenlenmis sekilde gonderilir
        $event->setResponse($response);
    }
}