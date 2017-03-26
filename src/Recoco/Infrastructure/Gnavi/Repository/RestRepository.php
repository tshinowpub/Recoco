<?php

namespace Recoco\Infrastructure\Gnavi\Repository;

use Recoco\Domain\Gnavi\Repository\RestRepositoryInterface;
use Recoco\Domain\Gnavi\Entity\Rest;

use CrEOF\Spatial\PHP\Types\Geometry\Point;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\Criteria;

class RestRepository extends EntityRepository implements RestRepositoryInterface
{

    public function saveRest(Rest $rest)
    {
        $this->getEntityManager()->persist($rest);
    }

    public function getNearRests(Point $point, int $distance): array
    {
        $rests = [];

        $rests = $this
            ->createQueryBuilder('r')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();

        return $rests;
    }
}
