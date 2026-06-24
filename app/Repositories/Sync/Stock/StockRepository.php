<?php

namespace App\Repositories\Sync\Stock;

use App\Constant\Query;
use App\Models\Sync\Stock\Stock;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class StockRepository
{
    public function __construct(private Stock $stock){}

    public function getAll(int $accountId, array $filters): LengthAwarePaginator
    {
        return $this->stock->query()
            ->where('account_id', $accountId)
            ->orderBy(Query::COLUMN_ID, Query::SORT_DESC)
            ->paginate($filters['perPage'] ?? Query::PER_PAGE);
    }

    public function getLastDate(int $accountId): string
    {
        $lastDate = $this->stock->query()
            ->where('account_id', $accountId)
            ->max('date');

        return $lastDate ?? Carbon::today()->toDateString();
    }

    public function upsert(array $data): int
    {
        return $this->stock->query()->upsert
        (
            $data,
            [
                'account_id',
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
