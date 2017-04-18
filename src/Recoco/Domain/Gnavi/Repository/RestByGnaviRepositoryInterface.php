<?php

namespace Recoco\Domain\Gnavi\Repository;

use Recoco\Domain\Gnavi\Criteria\RestSearchByGnavi;

interface RestByGnaviRepositoryInterface
{
    public function getRestsByGnavi(RestSearchByGnavi $restSearchByGnavi);
}
