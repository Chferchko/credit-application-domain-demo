<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Domain;

enum Broker
{
    case Sfinance;

    public function toString(): string
    {
        return match ($this) {
            self::Sfinance => 'sfinance',
        };
    }
}
