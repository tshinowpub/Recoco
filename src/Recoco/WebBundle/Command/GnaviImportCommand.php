<?php

namespace Recoco\WebBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

use Recoco\Domain\Gnavi\Criteria\RestSearchByGnavi;
use Recoco\Domain\Gnavi\Entity\Rest;

use CrEOF\Spatial\PHP\Types\Geometry\Point;

class GnaviImportCommand extends ContainerAwareCommand
{
    private $config;

    const BASE_URL = 'https://api.gnavi.co.jp/RestSearchAPI/20150630/';

    protected function configure()
    {
        $this
            ->setName('gnavi:import')
            ->setDescription('Import rests form Gnavi.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->setConfig();
        if(!$this->validateConfig()) {
            $output->writeln('Please correct settings to gnavi_import.yml');
            return ;
        }

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
            ->setLatitude($this->config['latitude'])
            ->setLongitude($this->config['longitude'])
            ->setRange($this->config['range'])
            ->setKeyId($this->config['keyId'])
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

   private function setConfig()
   {
       $path = __DIR__ . '/../Resources/config/gnavi_import.yml';

       try {
           $config = Yaml::parse(file_get_contents($path));
       } catch (ParseException $e) {
           printf("Unable to parse the YAML string: %s", $e->getMessage());
       }

       $this->config = $config;
   }

   private function validateConfig()
   {
       $validate = true;

       if(!isset($this->config['latitude'])) {
           $validate = false;
       }

       if(!isset($this->config['longitude'])) {
           $validate = false;
       }

       if(!isset($this->config['range'])) {
           $validate = false;
       }

       if(!isset($this->config['keyId'])) {
           $validate = false;
       }

       return $validate;
   }

}
