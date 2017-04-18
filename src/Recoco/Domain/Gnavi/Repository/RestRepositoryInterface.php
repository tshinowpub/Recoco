<?php

namespace Recoco\Domain\Gnavi\Repository;

use Recoco\Domain\Gnavi\Entity\Rest;
use CrEOF\Spatial\PHP\Types\Geometry\Point;

interface RestRepositoryInterface
{
    public function saveRest(Rest $rest);

    public function GetNearRests(Point $point, int $distance);
}
