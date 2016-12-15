<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Utilisateurs;
use AppBundle\Form\LyceenType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



class EspaceLyceenController extends Controller
{
    public function inscriptionAction(Request $request)
    {
        $utilisateur = new Utilisateurs();
        $utilisateur->setType(1);
        $form = $this->createForm(new LyceenType(), $utilisateur);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($utilisateur);
            $em->flush();

            $this
                ->addFlash('success',
                    'Vos informations ont été enregistrées. Nous vous contacterons très vite.');
        }

        return $this->render('AppBundle:EspaceLyceen:inscription.html.twig', array(
            'form' => $form->createView()
        ));
    }

}
