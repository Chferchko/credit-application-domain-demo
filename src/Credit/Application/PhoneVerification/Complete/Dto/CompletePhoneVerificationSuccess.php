<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Application\PhoneVerification\Complete\Dto;

use Ramsey\Uuid\UuidInterface;

final readonly class CompletePhoneVerificationSuccess
{
    public function __construct(
        public UuidInterface $confirmId,
    ) {}
}
