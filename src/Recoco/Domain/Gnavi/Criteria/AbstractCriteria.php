<?php

namespace Recoco\Domain\Gnavi\Criteria;

use Recoco\Domain\Gnavi\Criteria\CriteriaInterface;

abstract class AbstractCriteria implements CriteriaInterface
{

    public function toArray()
    {
        return get_object_vars($this);
    }

}
