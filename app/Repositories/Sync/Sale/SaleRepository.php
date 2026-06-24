<?php

namespace App\Repositories\Sync\Sale;

use App\Constant\Query;
use App\Models\Sync\Sale\Sale;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class SaleRepository
{
    public function __construct(private Sale $sale){}

    public function getAll(int $accountId, array $filters): LengthAwarePaginator
    {
        return $this->sale->query()
            ->where('account_id', $accountId)
            ->orderBy(Query::COLUMN_ID, Query::SORT_DESC)
            ->paginate($filters['perPage'] ?? Query::PER_PAGE);
    }

    public function getLastDate(int $accountId): string
    {
        $lastDate = $this->sale->query()
            ->where('account_id', $accountId)
            ->max('date');

        return $lastDate ?? Carbon::today()->startOfMonth()->toDateString();
    }

    public function upsert(array $data): int
    {
        return $this->sale->query()->upsert
        (
            $data,
            [
                'account_id',
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
