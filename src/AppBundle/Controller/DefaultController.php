<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Entity\DevisAutocar;
use AppBundle\Form\ContactType;
use AppBundle\Form\DevisAutocarType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Swift_Attachment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $pageAccueil = $em->getRepository('AppBundle:Page')->findOneByName('accueil');

        return ['pageAccueil' => $pageAccueil];
    }

    /**
     * @Route("/contact", name="contactpage")
     * @Template()
     */
    public function contactAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($request->isMethod('POST')) {
            if ($form->isSubmitted()) {
                $em->persist($contact);
                $em->flush();
                $message = \Swift_Message::newInstance()
                    ->setSubject('Prise de contact')
                    ->setFrom('no-reply@chaumont-voyages.fr')
                    ->setTo('veronique@chaumontvges.com')
                    ->setBody(
                        $this->render(':Email:contact.html.twig', array('contact' => $contact)),
                        'text/html'
                    );
                $message->addPart($message->getBody(), 'text/plain');
                $mailer = $this->get('mailer');
                $mailer->send($message);

                $this->addFlash('success', 'Nous avons bien reçu votre devis ! Nous reviendrons vers vous dans les plus brefs délais !');

                return $this->redirectToRoute('contactpage');
            }
        }

        return ['form' => $form->createView()];
    }

    /**
     * @Route("/notre-agence", name="chaumontvoyagespage")
     * @Template()
     */
    public function chaumontvoyagesAction(Request $request)
    {
        return [];
    }

    /**
     * @Route("/autocars-tti", name="autocarsttipage")
     * @Template("@App/default/autocars_tti.html.twig")
     */
    public function autocarsTtiAction(Request $request)
    {
       return [];
    }

    /**
     * @Route("/notre-flotte", name="flottepage")
     * @Template()
     */
    public function flotteAction(Request $request)
    {
        return [];
    }

    /**
     * @Route("/devis", name="devispage")
     * @Template("@App/default/devis.html.twig")
     */
    public function devisAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $devisAutocar = new DevisAutocar();

        $form = $this->createForm(DevisAutocarType::class, $devisAutocar);

        $form->handleRequest($request);

        if ($request->isMethod('POST')) {
            if ($form->isSubmitted()) {
                $devisAutocar->uploadDocuments();
                $em->persist($devisAutocar);
                $em->flush();

                $message = \Swift_Message::newInstance()
                    ->setSubject('Demande de devis autocars')
                    ->setFrom('no-reply@chaumont-voyages.fr')
                    ->setTo('veronique@chaumontvges.com')
                    ->setBody(
                        $this->render(':Email:devisAutocars.html.twig', array('devisAutocars' => $devisAutocar)),
                        'text/html'
                    )
                    ->attach(Swift_Attachment::fromPath($devisAutocar->getUploadRootDir() . '/' . $devisAutocar->getDocuments()))
                ;
                $message->addPart($message->getBody(), 'text/plain');
                $mailer = $this->get('mailer');
                $mailer->send($message);

                $this->addFlash('success', 'Nous avons bien reçu votre devis ! Nous reviendrons vers vous dans les plus brefs délais !');

                return $this->redirectToRoute('devispage');
            }
        }

        return ['form' => $form->createView()];
    }
}