<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Page;
use AppBundle\Form\AccueilType;
use AppBundle\Form\AutocarsTtiType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $accueilPage = $em->getRepository('AppBundle:Page')->findOneByName('accueil');
        $contentPage = $accueilPage->getContent();

        $page = new Page();

        $formAccueil = $this->createForm(AccueilType::class, $contentPage);
        $formAutocarsTti = $this->createForm(AutocarsTtiType::class);
        $formAccueil->handleRequest($request);

        if ($request->isMethod('POST')) {
            if ($formAccueil->isSubmitted() && $formAccueil->isValid()) {
                $data = $formAccueil->getData();
                $page->setContent($data);
                $page->setName('accueil');

                $em->persist($page);
                $em->flush();
            }
        }

        return ['formAccueil' => $formAccueil->createView(), 'accueilPage' => $accueilPage];
    }

}
