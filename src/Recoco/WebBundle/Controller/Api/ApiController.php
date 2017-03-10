<?php

namespace Recoco\WebBundle\Controller\Api;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Recoco\WebBundle\Form\ApiRestType;
use Recoco\Domain\Gnavi\Entity\Rest;

class ApiController extends Controller
{
    /**
     * @Route("/api/{version}/rest/get")
     *
     */
    public function apiAction(Request $request, $version)
    {
        $form = $this->createForm(ApiRestType::class, null, [
            'method' => 'GET',
        ]);

        $form->handleRequest($request);
        if ($form->isValid()) {
        }

        $criteria = [
            'latitude' => 34.6952161,
            'longitude' => 135.5015264,
        ];

        $Rests = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('Recoco:Rest')
            ->findByCriteria($criteria);

        return JsonResponse::create([
            'Rests' => $Rests
        ]);
    }
}
