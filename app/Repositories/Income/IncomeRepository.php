<?php

namespace App\Repositories\Income;

use App\Models\Income\Income;

class IncomeRepository
{
    public function __construct(private Income $income){}

    public function upsert(array $data): int
    {
        return $this->income->query()->upsert
        (
            $data,
            [
                'income_id',
                'nm_id',
                'barcode'
            ],
            [
                'date',
                'last_change_date',
                'date_close',
                'supplier_article',
                'tech_size',
                'warehouse_name',
                'number',
                'total_price',
                'quantity'
            ]
        );
    }
}