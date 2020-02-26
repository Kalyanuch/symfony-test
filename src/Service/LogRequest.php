<?php
namespace App\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\LogRequest as LogRequestEntity;

class LogRequest
{
    protected $container;
    protected $em;
    protected $geolocationKey;
    protected $geolocationUrl;

    public function __construct(ContainerInterface $container, EntityManagerInterface $manager, $geolocationKey, $geolocationUrl)
    {
        $this->container = $container;
        $this->em = $manager;
        $this->geolocationKey = $geolocationKey;
        $this->geolocationUrl = $geolocationUrl;
    }

    public function processRequest($isError = false)
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();

        if(in_array($request->getMethod(), ['GET', 'POST']))
        {
            $action = '';
            $method = '';
            $geoData = [];
            $city = '';
            $country = '';

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

            if(in_array($request->getClientIp(), ['127.0.0.1', 'localhost']))
            {
                $geoData = json_decode(file_get_contents(sprintf($this->geolocationUrl, '95.133.244.196', $this->geolocationKey)), true);
            } else
            {
                $geoData = json_decode(file_get_contents(sprintf($this->geolocationUrl, $request->getClientIp(), $this->geolocationKey)), true);
            }

            if($geoData)
            {
                $city = $geoData['city'];
                $country = $geoData['country_name'];
            }

            $obEntity = new LogRequestEntity();
            $obEntity->setAction($action)
                ->setCity($city)
                ->setCountry($country)
                ->setData((string)$request)
                ->setIp($request->getClientIp())
                ->setMethod($method)
                ->setType($request->getMethod());

            $this->em->persist($obEntity);
            $this->em->flush();
        }
    }
}