<?php

namespace Recoco\WebBundle\Controller\Api;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Recoco\WebBundle\Form\ApiRestType;
use Recoco\Domain\Gnavi\Entity\Rest;

class ApiController extends AbstractApiController
{
    /**
     * @Route("/api/{version}/rests/get")
     *
     */
    public function getRests(Request $request, $version)
    {
        return $this->apiAction($request, $version);
    }
}
