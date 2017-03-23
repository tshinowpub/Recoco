<?php

namespace Recoco\WebBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

use Recoco\Domain\Gnavi\Entity\Rest;

use CrEOF\Spatial\PHP\Types\Geometry\Point;

use GuzzleHttp\Client;

class GnaviImportCommand extends ContainerAwareCommand
{
    const BASE_URL = 'https://api.gnavi.co.jp/RestSearchAPI/20150630/';

    protected function configure()
    {
        $this->setName('gnavi:import');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = new Client();
        $response = $client->request('GET', self::BASE_URL, [
            'verify' => false,
            'query' => [
                'input_coordinates_mode' => 1,
                'coordinates_mode' => 1,
                'latitude' => 34.6952161,
                'longitude' => 135.5015264,
                'range' => 3,
                'keyid' => '6f78403ab1320b9db172ebac0d607e0f',
                'format' => 'json',
            ]
        ]);

        $apiRests = [];
        if($response->getStatusCode() == '200') {

            $json = $response->getBody();

            $apiData = json_decode($json);
            if(!is_null($apiData)) {
                $apiRests = $apiData->rest;
            }
        }

        $em = $this->getContainer()->get('doctrine')->getEntityManager();

        foreach($apiRests as $apiRest) {

            $rest = $this->createRest($apiRest);

            $SaveRest = $this->getContainer()->get('recoco.domain.gnavi.usecase.save_rest');
            $SaveRest->saveRest($rest);
        }

        $em->flush();

        $output->writeln('complete');
    }

    private function createRest($apiRest)
    {
        $rest = new Rest();
        $rest
            ->setGnaviId($apiRest->id)
            ->setName($apiRest->name)
            ->setNameKana($apiRest->name_kana)
            ->setTel($apiRest->tel)
            ->setAddress($apiRest->address)
            ->setLatlng(new Point($apiRest->latitude, $apiRest->longitude))
            ;

        return $rest;
   }
}
