<?php

declare(strict_types=1);

namespace Extensions\Classes\Credit\Domain\Entity\CreditOrderItem;

final readonly class ProductSnapshot
{
    public function __construct(
        public string $id,
        public string $sku,
        public string $name,
        public ?string $brand,
        public string $mainCategory,
        public float $price,
    ) {
    }

    /**
     * @return array{
     *     id: string,
     *     sku: string,
     *     name: string,
     *     brand: ?string,
     *     mainCategory: string,
     *     price: float
     * }
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'sku' => $this->sku,
            'name' => $this->name,
            'brand' => $this->brand,
            'mainCategory' => $this->mainCategory,
            'price' => $this->price,
        ];
    }

    /**
     * @param array{
     *     id: string,
     *     sku: string,
     *     name: string,
     *     brand?: ?string,
     *     mainCategory: string,
     *     price: float|int|numeric-string
     * } $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            sku: $data['sku'],
            name: $data['name'],
            brand: $data['brand'] ?? null,
            mainCategory: $data['mainCategory'],
            price: (float) $data['price'],
        );
    }
}
