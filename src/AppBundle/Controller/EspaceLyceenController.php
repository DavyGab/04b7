<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Utilisateurs;
use AppBundle\Form\UtilisateursType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;



class EspaceLyceenController extends Controller
{
    public function inscriptionAction(Request $request)
    {
        $utilisateur = new Utilisateurs();
        $utilisateur->setType(1);
        $form = $this->createForm(new UtilisateursType(), $utilisateur);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($utilisateur);
            $em->flush();

            $request
                ->addFlash('success',
                    'Vos informations ont été enregistrées. Nous vous contacterons très vite.');
        }

        return $this->render('AppBundle:EspaceLyceen:inscription.html.twig', array(
            'form' => $form->createView()
        ));
    }

}
