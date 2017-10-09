<?php

namespace System\TPBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SystemTPBundle:Default:index.html.twig');
    }
}
