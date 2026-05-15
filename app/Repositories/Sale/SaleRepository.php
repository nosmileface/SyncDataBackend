<?php

namespace App\Repositories\Sale;

use App\Models\Sale\Sale;

class SaleRepository
{
    public function __construct(private Sale $sale){}

    public function upsert(array $data): int
    {
        return $this->sale->query()->upsert
        (
            $data,
            [
                'g_number',
                'sale_id',
                'nm_id',
                'barcode'
            ],
            [
                'income_id',
                'odid',
                'date',
                'last_change_date',
                'supplier_article',
                'tech_size',
                'subject',
                'category',
                'brand',
                'country_name',
                'oblast_okrug_name',
                'region_name',
                'warehouse_name',
                'total_price',
                'price_with_disc',
                'finished_price',
                'for_pay',
                'promo_code_discount',
                'discount_percent',
                'spp',
                'is_supply',
                'is_realization',
                'is_storno'
            ]
        );
    }
}