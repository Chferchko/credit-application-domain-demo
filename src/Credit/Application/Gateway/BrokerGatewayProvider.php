<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Application\Gateway;

use Extensions\Classes\Credit\Domain\Broker;

interface BrokerGatewayProvider
{
    public function forBroker(Broker $broker): BrokerGateway;
}
