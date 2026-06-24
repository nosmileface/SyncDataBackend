<?php

namespace App\Repositories\Sync\Order;

use App\Constant\Query;
use App\Models\Sync\Order\Order;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderRepository
{
    public function __construct(private Order $order){}

    public function getAll(int $accountId, array $filters): LengthAwarePaginator
    {
        return $this->order->query()
            ->where('account_id', $accountId)
            ->orderBy(Query::COLUMN_ID, Query::SORT_DESC)
            ->paginate($filters['perPage'] ?? Query::PER_PAGE);
    }

    public function getLastDate(int $accountId): string
    {
        $lastDate = $this->order->query()
            ->where('account_id', $accountId)
            ->max('date');

        return $lastDate
            ? Carbon::parse($lastDate)->toDateString()
            : Carbon::today()->startOfMonth()->toDateString();
    }

    public function upsert(array $data): int
    {
        return $this->order->query()->upsert
        (
            $data,
            [
                'account_id',
                'g_number',
                'nm_id',
                'barcode'
            ],
            [
                'odid',
                'date',
                'last_change_date',
                'cancel_dt',
                'supplier_article',
                'tech_size',
                'subject',
                'category',
                'brand',
                'oblast',
                'warehouse_name',
                'total_price',
                'discount_percent',
                'income_id',
                'is_cancel'
            ]
        );
    }
}
