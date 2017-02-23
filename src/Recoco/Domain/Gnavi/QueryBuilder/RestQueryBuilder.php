<?php

namespace Recoco\Domain\Gnavi\QueryBuilder;

use Recoco\Domain\Api\QueryBuilder\QueryBuilderInterface;

class RestQueryBuilder implements QueryBuilderInterface
{
    private $query;
    private $format;

    public function setQueryFromCriteria($criteria)
    {
        if(isset($criteria['input_coordinates_mode'])) {
            $query['input_coordinates_mode'] = $criteria['input_coordinates_mode'];
        }
        if(isset($criteria['coordinates_mode'])) {
            $query['coordinates_mode'] = $criteria['coordinates_mode'];
        }
        if(isset($criteria['latitude'])) {
            $query['latitude'] = $criteria['latitude'];
        }
        if(isset($criteria['longitude'])) {
            $query['longitude'] = $criteria['longitude'];
        }
        if(isset($criteria['range'])) {
            $query['range'] = $criteria['range'];
        }

        $this->query = $query;

        return $this;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function buildQuery()
    {
        return http_build_query($this->query);
    }
}
