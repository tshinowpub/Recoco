<?php

namespace Recoco\Domain\Gnavi\Usecase;

use Recoco\Domain\Gnavi\Repository\RestRepositoryInterface;
use Recoco\Domain\Gnavi\Entity\Rest;

class SaveRest
{
    private $repository;

    public function __construct(RestRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function saveRest(Rest $rest)
    {
        $this->repository->saveRest($rest);
    }

}
