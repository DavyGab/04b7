<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;


class AdminController extends Controller
{
    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function usersAction(Request $request) {
        $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Utilisateurs');
        $utilisateurs = $repository->findAll();

        if ($request->query->get('type') == 'csv') {
        }
        return $this->render('AppBundle:Admin:users.html.twig', array(
            'users' => $utilisateurs
        ));
    }
}
