<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TemoignagesController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppBundle:Temoignages:index.html.twig');
    }
}
