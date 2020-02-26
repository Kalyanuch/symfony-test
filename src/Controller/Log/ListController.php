<?php
namespace App\Controller\Log;

use App\Controller\BaseController;
use App\Repository\LogRequestRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends BaseController
{
    protected $repository;
    protected $container;

    public function __construct(LogRequestRepository $repository, ContainerInterface $container)
    {
        $this->repository = $repository;
        $this->container = $container;
    }

    /**
     * @Route("/log")
     */
    public function index()
    {
        $this->setTitle('Log list');

        $this->addBreadcrumb('Homepage','/');
        $this->addBreadcrumb('Log', '/log', true);

        $this->data['headingTitle'] = 'Request logs';

        $this->data['textEmpty'] = 'No results here...';

        $this->data['columnAction'] = 'Action';
        $this->data['columnMethod'] = 'Method';
        $this->data['columnIp'] = 'Ip';
        $this->data['columnCity'] = 'City';
        $this->data['columnCountry'] = 'Country';
        $this->data['columnType'] = 'Type';
        $this->data['columnData'] = 'Data';
        $this->data['columnActions'] = 'Actions';

        $this->data['items'] = [];

        $items = $this->repository->findAll();

        foreach($items as $item)
        {
            array_push($this->data['items'], [
                'id' => $item->getId(),
                'action' => $item->getAction(),
                'method' => $item->getMethod(),
                'ip' => $item->getIp(),
                'city' => $item->getCity(),
                'country' => $item->getCountry(),
                'type' => $item->getType(),
                'data' => substr($item->getData(), 0, 30),
                'fullData' => $item->getData(),
                'actions' => [
                    'edit' => [
                        'href' => '/log/edit/' . $item->getId(),
                        'title' => 'Edit',
                        'icon' => 'fa-pencil-square-o'
                    ],
                    'delete' => [
                        'href' => '/log/delete/' . $item->getId(),
                        'title' => 'Delete',
                        'icon' => 'fa-trash'
                    ]
                ]
            ]);
        }

        return $this->render('log/list.html.twig', $this->data);
    }
}