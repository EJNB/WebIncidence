<?php

namespace System\IncidenceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SystemIncidenceBundle:Default:index.html.twig');
    }
}
