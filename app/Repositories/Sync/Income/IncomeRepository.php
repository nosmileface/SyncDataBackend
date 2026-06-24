<?php

namespace App\Repositories\Sync\Income;

use App\Constant\Query;
use App\Models\Sync\Income\Income;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class IncomeRepository
{
    private const int SUB_DAYS = 3;

    public function __construct(private Income $income){}

    public function getAll(int $accountId, array $filters): LengthAwarePaginator
    {
        return $this->income->query()
            ->where('account_id', $accountId)
            ->orderBy(Query::COLUMN_ID, Query::SORT_DESC)
            ->paginate($filters['perPage'] ?? Query::PER_PAGE);
    }

    public function getLastDate(int $accountId): string
    {
        $lastDate = $this->income->query()
            ->where('account_id', $accountId)
            ->max('date');

        return $lastDate
            ? Carbon::parse($lastDate)->subDays(self::SUB_DAYS)->toDateString()
            : Carbon::today()->startOfYear()->toDateString();
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
