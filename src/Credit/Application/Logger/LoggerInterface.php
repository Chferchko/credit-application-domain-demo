<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Application\Logger;

interface LoggerInterface
{
    /** @param mixed[] $context */
    public function error(string $message, array $context = []): void;
}
