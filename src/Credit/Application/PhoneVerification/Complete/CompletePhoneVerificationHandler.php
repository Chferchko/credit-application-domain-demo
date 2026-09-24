<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Application\PhoneVerification\Complete;

use Extensions\Classes\Credit\Application\Gateway\BrokerGatewayProvider;
use Extensions\Classes\Credit\Application\PhoneVerification\Complete\Dto\CompletePhoneVerificationCommand;
use Extensions\Classes\Credit\Application\PhoneVerification\Complete\Dto\CompletePhoneVerificationSuccess;
use Extensions\Classes\Credit\Application\PhoneVerification\Complete\Exception\CompletePhoneVerificationFailed;

final readonly class CompletePhoneVerificationHandler
{
    public function __construct(
        private BrokerGatewayProvider $brokerGatewayProvider,
    ) {}

    /** @throws CompletePhoneVerificationFailed */
    public function handle(CompletePhoneVerificationCommand $command): CompletePhoneVerificationSuccess
    {
        return $this->brokerGatewayProvider->forBroker($command->broker)->completePhoneVerification($command->confirmId, $command->code);
    }
}
