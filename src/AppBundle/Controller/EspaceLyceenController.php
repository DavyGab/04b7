<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Utilisateurs;
use AppBundle\Form\LyceenType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class EspaceLyceenController extends Controller
{
    public function inscriptionAction(Request $request)
    {
        $utilisateur = new Utilisateurs();
        $utilisateur->setType(1);
        $form = $this->createForm(new LyceenType(), $utilisateur);
        $post = 'none';

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($utilisateur);
            $em->flush();
            $post = 'block';

            $info = $this->get('app.info');

            $message = \Swift_Message::newInstance()
                ->setSubject('Confirmation d\'inscription')
                ->setFrom($this->container->getParameter('no_reply'))
                ->setTo($utilisateur->getEmail())
                ->setBody(
                    $this->renderView(
                        'AppBundle:EspaceLyceen:mailInscription.html.twig',
                        array(
                            'prenom' => $utilisateur->getPrenom(),
                            'offre' => $info->getOffreNom($utilisateur->getOffre())
                        )
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);
        }

        return $this->render('AppBundle:EspaceLyceen:inscription.html.twig', array(
            'form' => $form->createView(),
            'post' => $post
        ));
    }

}
