<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Application\CreditCreation\Dto;

use Extensions\Classes\Credit\Domain\Entity\CreditOrderItem\ProductId;
use Extensions\Classes\Credit\Domain\Entity\CreditOrderItem\ProductSnapshot;
use Extensions\Classes\Credit\Domain\Entity\CreditOrderItem\QuantityMeasure;

final readonly class CreditOrderItemPayload
{
    public function __construct(
        public ProductId $productId,
        public float $quantity,
        public QuantityMeasure $quantityMeasure,
        public ProductSnapshot $productSnapshot,
    ) {}
}
