<?php
namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use App\Service\LogRequest;

class RequestListener
{
    protected $service;

    public function __construct(LogRequest $service)
    {
        $this->service = $service;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $this->service->processRequest();
    }
}