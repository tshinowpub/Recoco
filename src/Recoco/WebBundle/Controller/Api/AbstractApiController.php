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

        $datas = [
            'latitude' => $request->query->get('latitude'),
            'longitude' => $request->query->get('longitude'),
            'distance' => $request->query->get('distance'),
        ];

        $form->submit($datas);
        if (!$form->isValid()) {
            throw new \InvalidArgumentException("Form is not valid.");
        }

        $rests = [];

        $point = new Point(
            $form["latitude"]->getData(),
            $form["longitude"]->getData()
        );

        $getNearRests = $this->get('recoco.domain.gnavi.usecase.get_near_rests');
        $rests = $getNearRests->getNearRests($point, $form["distance"]->getData());

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
