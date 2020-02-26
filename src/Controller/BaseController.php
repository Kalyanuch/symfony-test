<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
    protected $data = ['title' => '', 'breadcrumbs' => []];

    public function index()
    {
        return $this->render('base.html.twig', $this->data);
    }

    protected function addBreadcrumb($title, $href, $isPage = false)
    {
        array_push($this->data['breadcrumbs'], ['title' => $title, 'href' => $href, 'isPage' => $isPage]);
    }

    protected function setTitle($title)
    {
        $this->data['title'] = $title;
    }
}
