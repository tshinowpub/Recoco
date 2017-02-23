<?php

namespace Recoco\WebBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ApiController extends Controller
{
    /**
     * @Route("/api/{version}/rest/get")
     *
     */
    public function apiAction($version)
    {
        return $this->render('RecocoWebBundle:Default:index.html.twig');
    }
}
