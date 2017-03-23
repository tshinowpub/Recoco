<?php

namespace Recoco\Domain\Gnavi\Repository;

use Recoco\Domain\Gnavi\Entity\Rest;

interface RestRepositoryInterface
{
    public function saveRest(Rest $rest);
}
