<?php
namespace App\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
#use Symfony\Component\HttpFoundation\Request;
#use Symfony\Component\HttpKernel\Controller\ControllerResolver;
#use Symfony\Component\Routing\Router;

class LogRequest
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function processRequest()
    {

        #echo '<pre>';print_r($this->container);exit;
        #$request = Request::createFromGlobals();
        #$router = new Router();
        #$resolver = new ControllerResolver();
        //$resolver->getController()

        #print_r($request->attributes);exit;

        //$router = $this->container->get('router');
        //echo '<pre>';print_r($router->getRouteCollection());exit;
        $request = $this->container->get('request_stack');
        #print_r($request->getCUrrentRequest()->attributes);exit;
    }
}