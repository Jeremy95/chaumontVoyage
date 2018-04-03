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
     * @Route("/notre-agence", name="chaumontvoyagepage")
     * @Template()
     */
    public function chaumontVoyageAction(Request $request)
    {
        return [];
    }

    /**
     * @Route("/autocars-tti", name="autocarsttipage")
     * @Template()
     */
    public function autocarsTTIAction(Request $request)
    {
        return [];
    }
}
