<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class ExceptionController extends BaseController
{
    public function index()
    {
        $this->setTitle('404 Error - Not Found');

        $this->addBreadcrumb('Homepage','/');
        $this->addBreadcrumb('Page not found', '/', true);

        $this->data['headingTitle'] = '404 - page not found!';
        $this->data['textInfo'] = 'Try return to homepage';
        $this->data['textButton'] = 'Go homepage';
        $this->data['hrefButton'] = '/';

        return $this->render('error.html.twig', $this->data);
    }
}