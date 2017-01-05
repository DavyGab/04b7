<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class AdminController extends Controller
{
    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function usersAction() {
        $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Utilisateurs');
        $utilisateurs = $repository->findAll();

        return $this->render('AppBundle:Admin:users.html.twig', array(
            'users' => $utilisateurs
        ));
    }
}
