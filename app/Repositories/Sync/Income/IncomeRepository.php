<?php

namespace App\Repositories\Sync\Income;

use App\Models\Sync\Income\Income;

class IncomeRepository
{
    public function __construct(private Income $income){}

    public function upsert(array $data): int
    {
        return $this->income->query()->upsert
        (
            $data,
            [
                'account_id',
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
