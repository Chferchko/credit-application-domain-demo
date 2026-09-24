<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Application\CreditCreation\Exception;

use Ramsey\Uuid\UuidInterface;

final class CreateCreditFailedException extends \RuntimeException
{
    public function __construct(
        public readonly UuidInterface $confirmId,
        ?\Throwable $previous = null,
    ) {
        parent::__construct(
            sprintf('Failed to create credit for confirmation "%s".', $confirmId->toString()),
            0,
            $previous,
        );
    }
}
