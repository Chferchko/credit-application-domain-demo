<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Application\CreditCreation\Dto;

use Extensions\Classes\Core\Domain\ValueObject\Email;
use Extensions\Classes\Core\Domain\ValueObject\FirstName;
use Extensions\Classes\Core\Domain\ValueObject\LastName;
use Extensions\Classes\Core\Domain\ValueObject\MiddleName;
use Extensions\Classes\Credit\Domain\Broker;
use Ramsey\Uuid\UuidInterface;

final readonly class CreateCreditCommand
{
    /** @param list<CreditOrderItemPayload> $orderItemsPayload */
    public function __construct(
        public Broker $broker,
        public UuidInterface $confirmId,
        public FirstName $firstName,
        public LastName $lastName,
        public ?MiddleName $middleName,
        public ?Email $email,
        public array $orderItemsPayload,
        public BrokerCreditPayload $payload,
    ) {}
}
