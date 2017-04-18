<?php

namespace Recoco\Domain\Gnavi\Usecase;

use Recoco\Domain\Gnavi\Repository\RestByGnaviRepositoryInterface;
use Recoco\Domain\Gnavi\Criteria\RestSearchByGnavi;

class GetCountPageRestsByGnavi
{
    private $repository;

    public function __construct(RestByGnaviRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getCountPageRestsByGnavi(RestSearchByGnavi $restSearchByGnavi)
    {
        return $this->repository->getCountPageRestsByGnavi($restSearchByGnavi);
    }

}
