<?php

namespace Recoco\Infrastructure\Gnavi\Repository;

use Recoco\Domain\Gnavi\Repository\RestRepositoryInterface;
use Recoco\Domain\Gnavi\Entity\Rest;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\Criteria;

class RestRepository extends EntityRepository implements RestRepositoryInterface
{

    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function saveRest(Rest $rest)
    {
        $this->entityManager->persist($rest);
    }

    public function findByCriteria(array $criteria, array $orderBy = null)
    {
        $Rests = $this->findAll();

        return $Rests;
    }
}
