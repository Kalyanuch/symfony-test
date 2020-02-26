<?php
namespace App\Controller\Log;

use App\Controller\BaseController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\LogRequestRepository;
use Doctrine\ORM\EntityManagerInterface;

class DeleteController extends BaseController
{
    protected $repository;
    protected $em;

    public function __construct(LogRequestRepository $repository, EntityManagerInterface $manager)
    {
        $this->repository = $repository;
        $this->em = $manager;
    }

    /**
     * @Route("/log/delete/{id}")
     */
    public function remove($id)
    {
        if($id && (int)$id > 0)
        {
            $item = $this->repository->find($id);

            if($item)
            {
                $this->em->remove($item);
                $this->em->flush();
            }
        }

        $this->setTitle('Item deleted successfully');

        $this->addBreadcrumb('Homepage','/');
        $this->addBreadcrumb('Log', '/log');
        $this->addBreadcrumb('Deleted', '', true);

        $this->data['headingTitle'] = 'Item #' . (int)$id . ' deleted successfully';
        $this->data['textInfo'] = 'Return to list';
        $this->data['textButton'] = 'Go to list';
        $this->data['hrefButton'] = '/log';

        return $this->render('log/delete.html.twig', $this->data);
    }
}