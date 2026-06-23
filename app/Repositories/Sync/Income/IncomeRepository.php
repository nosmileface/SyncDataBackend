<?php

namespace App\Repositories\Sync\Income;

use App\Models\Sync\Income\Income;
use Carbon\Carbon;

class IncomeRepository
{
    public function __construct(private Income $income){}

    public function getLastDate(int $accountId): string
    {
        $lastDate = $this->income->query()
            ->where('account_id', $accountId)
            ->max('date');

        return $lastDate ?? Carbon::today()->startOfMonth()->toDateString();
    }

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
