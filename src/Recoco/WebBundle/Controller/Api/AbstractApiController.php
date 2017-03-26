<?php

namespace Recoco\WebBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use CrEOF\Spatial\PHP\Types\Geometry\Point;

use Recoco\WebBundle\Form\ApiRestType;
use Recoco\Domain\Gnavi\Entity\Rest;

abstract class AbstractApiController extends Controller
{

    public function apiAction(Request $request, $version)
    {
        $form = $this->createForm(ApiRestType::class, null, [
            'method' => 'GET',
        ]);

        $form->handleRequest($request);
        if ($form->isValid()) {
        }

        $rests = [];

        $point = new Point(34.6952161, 135.5015264);

        $getNearRests = $this->get('recoco.domain.gnavi.usecase.get_near_rests');
        $rests = $getNearRests->getNearRests($point, 1000);

        $serializer = $this->get('recoco.infrastructure.api.serializer.json')->getSerializer();
        $responseRests = [];
        foreach($rests as $rest) {
            $responseRest = $serializer->serialize($rest, 'json');
            $responseRests[] = json_decode($responseRest);
        }

        return JsonResponse::create([
            'Rests' => $responseRests
        ]);
    }

}
