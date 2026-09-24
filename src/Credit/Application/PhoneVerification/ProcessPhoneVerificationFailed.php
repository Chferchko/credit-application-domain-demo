<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Application\PhoneVerification;

abstract class ProcessPhoneVerificationFailed extends \RuntimeException
{
    public function __construct(
        string $message,
        \Throwable $previous,
    ) {
        parent::__construct($message, 0, $previous);
    }
}
