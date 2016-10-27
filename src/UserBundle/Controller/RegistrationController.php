<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RegistrationController extends Controller
{
    public function loginAction()
    {
        return $this->render('UserBundle:Registration:login.html.twig', array(
            // ...
        ));
    }

    public function registrationAction()
    {
        return $this->render('UserBundle:Registration:registration.html.twig', array(
            // ...
        ));
    }

    public function forgetPasswordAction()
    {
        return $this->render('UserBundle:Registration:forgetPassword.html.twig', array(
            // ...
        ));
    }

}
