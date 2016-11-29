<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PresentationController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppBundle:Presentation:index.html.twig');
    }
}
