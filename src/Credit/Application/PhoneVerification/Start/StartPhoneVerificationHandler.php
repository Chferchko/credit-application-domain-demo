<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Application\PhoneVerification\Start;

use Extensions\Classes\Credit\Application\Gateway\BrokerGatewayProvider;
use Extensions\Classes\Credit\Application\PhoneVerification\Start\Dto\StartPhoneVerificationCommand;
use Extensions\Classes\Credit\Application\PhoneVerification\Start\Dto\StartPhoneVerificationSuccess;
use Extensions\Classes\Credit\Application\PhoneVerification\Start\Exception\StartPhoneVerificationFailed;

final readonly class StartPhoneVerificationHandler
{
    public function __construct(
        private BrokerGatewayProvider $brokerGatewayProvider,
    ) {}

    /** @throws StartPhoneVerificationFailed */
    public function handle(StartPhoneVerificationCommand $command): StartPhoneVerificationSuccess
    {
        return $this->brokerGatewayProvider->forBroker($command->broker)->startPhoneVerification($command->phone);
    }
}
