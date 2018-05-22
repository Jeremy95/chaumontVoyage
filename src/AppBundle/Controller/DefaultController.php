<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Entity\DevisAutocar;
use AppBundle\Form\ContactType;
use AppBundle\Form\DevisAutocarType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
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
        return [];
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

                $this->addFlash('success', 'Nous avons bien reçu votre devis ! Nous reviendrons vers vous dans les plus brefs délais !');

                return ['form' => $form->createView()];
            }
        }

        return ['form' => $form->createView()];
    }

    /**
     * @Route("/notre-agence", name="chaumontvoyagepage")
     * @Template()
     */
    public function chaumontVoyageAction(Request $request)
    {
        return [];
    }

    /**
     * @Route("/autocars-tti", name="autocarsttipage")
     * @Template("@App/Default/autocars_tti.html.twig")
     */
    public function autocarsTtiAction(Request $request)
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

                $this->addFlash('success', 'Nous avons bien reçu votre devis ! Nous reviendrons vers vous dans les plus brefs délais !');

                return ['form' => $form->createView()];
            }
        }

        return ['form' => $form->createView()];
    }
}
