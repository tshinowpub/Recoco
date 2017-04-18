<?php

namespace Recoco\WebBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

use Recoco\Domain\Gnavi\Criteria\RestSearchByGnavi;
use Recoco\Domain\Gnavi\Entity\Rest;

use CrEOF\Spatial\PHP\Types\Geometry\Point;

class GnaviImportCommand extends ContainerAwareCommand
{
    const BASE_URL = 'https://api.gnavi.co.jp/RestSearchAPI/20150630/';

    protected function configure()
    {
        $this->setName('gnavi:import');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rests = [];

        $totalPage = $this->getCountPageRestsByGnavi();
        $getRestsByGnavi = $this->getContainer()->get('recoco.domain.gnavi.usecase.get_rests_by_gnavi');
        for($i = 1; $i <= 1; $i++) {

            $criteria = $this->getCriteria($i);

            $responseRests = $getRestsByGnavi->getRestsByGnavi($criteria);
            foreach($responseRests as $responseRest) {
                $tempRest = $this->createRest($responseRest);
                $rests[] = $tempRest;
            }

        }

        $em = $this->getContainer()->get('doctrine')->getEntityManager();

        foreach($rests as $rest) {
            $SaveRest = $this->getContainer()->get('recoco.domain.gnavi.usecase.save_rest');
            $SaveRest->saveRest($rest);
        }

        $em->flush();

        $output->writeln('complete');
    }

    private function getCountPageRestsByGnavi()
    {
        $criteria = $this->getCriteria();

        $getCountPageRestsByGnavi = $this->getContainer()->get('recoco.domain.gnavi.usecase.get_count_page_rests_by_gnavi');

        return $getCountPageRestsByGnavi->getCountPageRestsByGnavi($criteria);
    }

    private function getCriteria($offset = null)
    {
        $restSearchByGnavi = new RestSearchByGnavi();

        $restSearchByGnavi
            ->setInputCoordinatesMode(1)
            ->setCoordinatesMode(1)
            ->setLatitude(34.6952161)
            ->setLongitude(135.5015264)
            ->setRange(5)
            ->setKeyId('6f78403ab1320b9db172ebac0d607e0f')
            ->setFormat('json')
            ;

        if(!is_null($offset)) {
            $restSearchByGnavi->setOffset($offset);
        }

        return $restSearchByGnavi;
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
