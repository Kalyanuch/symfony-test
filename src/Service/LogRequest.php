<?php
namespace App\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\LogRequest as LogRequestEntity;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;

class LogRequest
{
    protected $container;
    protected $em;

    public function __construct(ContainerInterface $container, EntityManagerInterface $manager)
    {
        $this->container = $container;
        $this->em = $manager;
    }

    public function processRequest($isError = false)
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();

        if(in_array($request->getMethod(), ['GET', 'POST']))
        {
            $action = '';
            $method = '';

            if($isError)
            {
                $action = 'index';
                $method = 'ExceptionController';
            } else
            {
                $arController = explode('\\', $request->attributes->get('_controller'));

                if(is_array($arController) && count($arController))
                    $arController = explode('::', array_pop($arController));

                if(is_array($arController) && count($arController))
                {
                    $method = $arController[0];
                    $action = $arController[1];
                }
            }


            $obEntity = new LogRequestEntity();
            $obEntity->setAction($action)
                ->setCity('')
                ->setCountry('')
                ->setData((string)$request)
                ->setIp($request->getClientIp())
                ->setMethod($method)
                ->setType($request->getMethod());

            $this->em->persist($obEntity);
            $this->em->flush();
        }
    }
}