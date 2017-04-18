<?php

namespace Recoco\Domain\Gnavi\Usecase;

use Recoco\Domain\Gnavi\Repository\RestByGnaviRepositoryInterface;
use Recoco\Domain\Gnavi\Criteria\RestSearchByGnavi;

class GetRestsByGnavi
{
    private $repository;

    public function __construct(RestByGnaviRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getRestsByGnavi(RestSearchByGnavi $restSearchByGnavi)
    {
        return $this->repository->getRestsByGnavi($restSearchByGnavi);
    }

}
