<?php

namespace Recoco\Domain\Gnavi\Usecase;

use Recoco\Domain\Gnavi\Repository\RestRepositoryInterface;
use CrEOF\Spatial\PHP\Types\Geometry\Point;

class GetNearRests
{
    private $repository;

    public function __construct(RestRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getNearRests(Point $point, int $distance) : array
    {
        return $this->repository->getNearRests($point, $distance);
    }
}
