<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Domain\Entity\CreditOrderItem;

use Ramsey\Uuid\UuidInterface;

final readonly class CreditOrderItem
{
    public function __construct(
        public UuidInterface $id,
        public UuidInterface $creditId,
        public ProductId $productId,
        public float $quantity,
        public QuantityMeasure $quantityMeasure,
        public ProductSnapshot $productSnapshot,
        public \DateTimeImmutable $createdAt,
    ) {
    }
}
