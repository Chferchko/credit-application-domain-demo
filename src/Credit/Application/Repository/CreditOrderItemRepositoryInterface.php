<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Application\Repository;

use Extensions\Classes\Credit\Application\Repository\Exception\RepositoryFailedException;
use Extensions\Classes\Credit\Domain\Entity\CreditOrderItem\CreditOrderItem;

interface CreditOrderItemRepositoryInterface
{
    /** @throws RepositoryFailedException */
    public function save(CreditOrderItem $item): void;
}
