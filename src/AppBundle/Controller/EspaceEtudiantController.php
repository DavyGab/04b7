<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Utilisateurs;
use AppBundle\Form\EtudiantType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;



class EspaceEtudiantController extends Controller
{
    public function indexAction(Request $request)
    {
        $utilisateur = new Utilisateurs();
        $utilisateur->setType(2);
        $form = $this->createForm(new EtudiantType(), $utilisateur);
        $post = 'none';

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($utilisateur);
            $em->flush();
            $post = 'block';

            $message = \Swift_Message::newInstance()
                ->setSubject('Confirmation d\'inscription')
                ->setFrom($this->container->getParameter('no_reply'))
                ->setTo($utilisateur->getEmail())
                ->setBody(
                    $this->renderView(
                        'AppBundle:EspaceEtudiant:mailInscription.html.twig',
                        array('prenom' => $utilisateur->getPrenom())
                    ),
                    'text/html'
                )
            ;
            $this->get('mailer')->send($message);
        }

        return $this->render('AppBundle:EspaceEtudiant:index.html.twig', array(
            'form' => $form->createView(),
            'post' => $post
        ));
    }

    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function listeAction() {
        $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Utilisateurs');
        $utilisateurs = $repository->findAll();

        dump($utilisateurs);

        exit;
        return new Response();
    }

}
