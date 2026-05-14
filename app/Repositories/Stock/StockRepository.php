<?php

namespace App\Repositories\Stock;

use App\Models\Stock\Stock;

class StockRepository
{
    public function __construct(private Stock $stock){}

    public function upsert(array $data): int
    {
        return $this->stock->query()->upsert
        (
            $data,
            [
                'sc_code',
                'nm_id',
                'barcode'
            ],
            [
                'date',
                'last_change_date',
                'supplier_article',
                'tech_size',
                'subject',
                'category',
                'brand',
                'warehouse_name',
                'in_way_to_client',
                'in_way_from_client',
                'price',
                'discount',
                'quantity',
                'quantity_full',
                'is_supply',
                'is_realization'
            ]
        );
    }
}