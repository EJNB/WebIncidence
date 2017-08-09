<?php

namespace System\ClaimBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SystemClaimBundle:Default:index.html.twig');
    }
}
