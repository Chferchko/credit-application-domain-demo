<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Domain\Entity\CreditCustomer;

use Extensions\Classes\Core\Domain\ValueObject\Email;
use Extensions\Classes\Core\Domain\ValueObject\FirstName;
use Extensions\Classes\Core\Domain\ValueObject\LastName;
use Extensions\Classes\Core\Domain\ValueObject\MiddleName;
use Extensions\Classes\Core\Domain\ValueObject\Phone;
use Ramsey\Uuid\UuidInterface;

final readonly class CreditCustomer
{
    public function __construct(
        public UuidInterface $id,
        public Phone $phone,
        public LastName $lastName,
        public FirstName $firstName,
        public ?MiddleName $middleName,
        public ?Email $email,
    ) {
    }
}
