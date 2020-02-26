<?php
namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use App\Service\LogRequest;

class ExceptionListener
{
    protected $service;

    public function __construct(LogRequest $service)
    {
        $this->service = $service;
    }

    public function onKernelException(ExceptionEvent $event)
    {
        $this->service->processRequest();
    }
}
