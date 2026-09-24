<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Domain\Entity\Credit;

use Extensions\Classes\Credit\Domain\Broker;
use Ramsey\Uuid\UuidInterface;

abstract class Credit
{
    public function __construct(
        public readonly UuidInterface $id,
        public ?ExternalId $externalId,
        public readonly Broker $broker,
        public InternalStatus $internalStatus,
        public readonly UuidInterface $customerId,
        public ?OrderId $orderId,
        public readonly \DateTimeImmutable $createdAt,
        public ?\DateTimeImmutable $updatedAt,
    ) {
    }
}
