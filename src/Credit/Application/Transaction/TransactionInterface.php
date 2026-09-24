<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Application\Transaction;

interface TransactionInterface
{
    public function begin(): void;

    public function commit(): void;

    public function rollback(): void;
}
