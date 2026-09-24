<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Application\Gateway;

use Extensions\Classes\Core\Domain\ValueObject\Phone;
use Extensions\Classes\Credit\Domain\ValueObject\PhoneCode;
use Extensions\Classes\Credit\Application\PhoneVerification\Complete\Dto\CompletePhoneVerificationSuccess;
use Extensions\Classes\Credit\Application\PhoneVerification\Complete\Exception\CompletePhoneVerificationFailed;
use Extensions\Classes\Credit\Application\PhoneVerification\Start\Dto\StartPhoneVerificationSuccess;
use Extensions\Classes\Credit\Application\PhoneVerification\Start\Exception\StartPhoneVerificationFailed;
use Ramsey\Uuid\UuidInterface;

interface BrokerGateway
{
    /** @throws StartPhoneVerificationFailed */
    public function startPhoneVerification(Phone $phone): StartPhoneVerificationSuccess;

    /** @throws CompletePhoneVerificationFailed */
    public function completePhoneVerification(UuidInterface $confirmId, PhoneCode $code): CompletePhoneVerificationSuccess;
}
