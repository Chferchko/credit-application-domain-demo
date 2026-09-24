<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Application\Repository;

use Extensions\Classes\Core\Domain\ValueObject\Phone;

interface Confirmation
{
    public function getPhone(): Phone;

    public function isConfirmed(): bool;
}
