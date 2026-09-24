<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Application\Repository;

use Extensions\Classes\Credit\Domain\Broker;

interface BrokerConfirmationRepositoryProvider
{
    public function forBroker(Broker $broker): BrokerConfirmationRepositoryInterface;
}
