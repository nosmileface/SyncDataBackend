<?php

namespace App\Repositories\Sync\Order;

use App\Models\Order\Order;

class OrderRepository
{
    public function __construct(private Order $order){}

    public function upsert(array $data): int
    {
        return $this->order->query()->upsert
        (
            $data,
            [
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
