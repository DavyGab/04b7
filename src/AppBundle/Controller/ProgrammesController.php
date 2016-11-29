<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProgrammesController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppBundle:Programmes:index.html.twig');
    }
}
