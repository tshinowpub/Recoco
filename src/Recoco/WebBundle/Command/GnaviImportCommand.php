<?php

namespace Recoco\WebBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

use Recoco\Domain\Gnavi\Entity\Rest;
use Recoco\Domain\Gnavi\QueryBuilder\RestQueryBuilder;

class GnaviImportCommand extends ContainerAwareCommand
{
    const BASE_URL = 'https://api.gnavi.co.jp/RestSearchAPI/20150630/';

    protected function configure()
    {
        $this->setName('gnavi:import');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $queryBuilder = new RestQueryBuilder();
        $queryBuilder->setQueryFromCriteria(
           array(
               'input_coordinates_mode' => 1,
               'coordinates_mode' => 1,
               'latitude' => 34.6952161,
               'longitude' => 135.5015264,
               'range' => 3
           )
        );

        $output->writeln('complete');
    }

}
