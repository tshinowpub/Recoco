<?php

namespace Recoco\Infrastructure\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\Criteria;

class RestRepository extends EntityRepository
{
    public function findByCriteria(array $criteria, array $orderBy = null)
    {
        $Rests = $this->findAll();
        
        return $Rests;
    }
}
