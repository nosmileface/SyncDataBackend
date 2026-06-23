<?php

namespace App\Repositories\Sync\Stock;

use App\Models\Sync\Stock\Stock;

class StockRepository
{
    public function __construct(private Stock $stock){}

    public function upsert(array $data): int
    {
        return $this->stock->query()->upsert
        (
            $data,
            [
                'nm_id',
                'barcode',
                'warehouse_name'
            ],
            [
                'sc_code',
                'date',
                'last_change_date',
                'supplier_article',
                'tech_size',
                'subject',
                'category',
                'brand',
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
