<?php

namespace AppBundle\Controller;

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
        return [];
    }

    /**
     * @Route("/entreprise", name="entreprisepage")
     * @Template()
     */
    public function entrepriseAction(Request $request)
    {
        return [];
    }

    /**
     * @Route("/particuliers", name="particulierspage")
     * @Template()
     */
    public function particuliersAction(Request $request)
    {
        return [];
    }
}
