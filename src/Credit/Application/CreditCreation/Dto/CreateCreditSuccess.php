<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Application\CreditCreation\Dto;

use Ramsey\Uuid\UuidInterface;

final readonly class CreateCreditSuccess
{
    public function __construct(
        public UuidInterface $creditId,
    ) {
    }
}
