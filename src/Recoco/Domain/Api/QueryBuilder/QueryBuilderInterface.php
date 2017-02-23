<?php

namespace Recoco\Domain\Api\QueryBuilder;

interface QueryBuilderInterface
{
    public function setQueryFromCriteria($criteria);

    public function getQuery();

    public function buildQuery();
}
