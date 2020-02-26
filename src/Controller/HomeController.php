<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class HomeController extends BaseController
{
    /**
        * @Route("/")
    */
    public function index()
    {
        $this->data['headingTitle'] = 'Project homepage';
        $this->data['copyrightYear'] = date('Y');
        $this->data['buttonSignIn'] = 'Sign In';
        $this->data['actionSignIn'] = '/log';

        return $this->render('home.html.twig', $this->data);
    }
}