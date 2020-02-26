<?php
namespace App\Controller\Log;

use App\Controller\BaseController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\LogRequest;

class ListController extends BaseController
{
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

        return $this->render('log/list.html.twig', $this->data);
    }
}