<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Application\CreditCreation;

use Extensions\Classes\Credit\Application\CreditCreation\Dto\BrokerCreditPayload;
use Extensions\Classes\Credit\Domain\Entity\Credit\Credit;
use Ramsey\Uuid\UuidInterface;

interface BrokerCreditFactoryInterface
{
    public function create(UuidInterface $customerId, BrokerCreditPayload $payload): Credit;
}
