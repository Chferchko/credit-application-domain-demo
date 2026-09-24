<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Application\PhoneVerification\Start\Dto;

use Extensions\Classes\Core\Domain\ValueObject\Phone;
use Extensions\Classes\Credit\Domain\Broker;

final readonly class StartPhoneVerificationCommand
{
    public function __construct(
        public Broker $broker,
        public Phone $phone,
    ) {}
}
