<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Application\Repository;

use Extensions\Classes\Credit\Domain\Entity\Credit\Credit;
use Extensions\Classes\Credit\Application\Repository\Exception\RepositoryFailedException;

interface BrokerCreditRepositoryInterface
{
    /** @throws RepositoryFailedException */
    public function save(Credit $credit): void;
}
