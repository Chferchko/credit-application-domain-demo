<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Application\CreditCreation;

use Extensions\Classes\Credit\Domain\Broker;

interface BrokerCreditFactoryProvider
{
    public function forBroker(Broker $broker): BrokerCreditFactoryInterface;
}
