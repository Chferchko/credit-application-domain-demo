<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Application\Repository;

use Extensions\Classes\Credit\Domain\Entity\CreditCustomer\CreditCustomer;
use Extensions\Classes\Credit\Application\Repository\Exception\RepositoryFailedException;

interface CreditCustomerRepositoryInterface
{
    /** @throws RepositoryFailedException */
    public function save(CreditCustomer $customer): void;
}
