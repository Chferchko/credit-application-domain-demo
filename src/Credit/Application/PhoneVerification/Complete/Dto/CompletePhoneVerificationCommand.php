<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Application\PhoneVerification\Complete\Dto;

use Extensions\Classes\Credit\Domain\Broker;
use Extensions\Classes\Credit\Domain\ValueObject\PhoneCode;
use Ramsey\Uuid\UuidInterface;

final readonly class CompletePhoneVerificationCommand
{
    public function __construct(
        public Broker $broker,
        public UuidInterface $confirmId,
        public PhoneCode $code,
    ) {}
}
