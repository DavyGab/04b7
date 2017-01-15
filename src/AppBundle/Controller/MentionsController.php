<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MentionsController extends Controller
{
    public function mentionsLegalesAction()
    {
        return $this->render('AppBundle:Mentions:mentions_legales.html.twig');
    }
    
    public function CGVAction()
    {
        return $this->render('AppBundle:Mentions:cgv.html.twig');
    }
}
