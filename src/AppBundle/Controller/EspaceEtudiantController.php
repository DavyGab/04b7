<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Utilisateurs;
use AppBundle\Form\UtilisateursType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EspaceEtudiantController extends Controller
{
    public function indexAction(Request $request)
    {
        $utilisateur = new Utilisateurs();
        $utilisateur->setType(2);
        $form = $this->createForm(new UtilisateursType(), $utilisateur);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($utilisateur);
            $em->flush();

            $request->getSession()->getFlashBag()
                ->add('success',
                    'Vos informations ont été enregistrées. Nous vous contacterons très vite.');
        }

        return $this->render('AppBundle:EspaceEtudiant:index.html.twig', array(
            'form' => $form->createView()
        ));
    }

}
