<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable
(
    [
        'g_number',
        'odid',
        'date',
        'last_change_date',
        'cancel_dt',
        'nm_id',
        'barcode',
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
)]
class Order extends Model
{
    //
}
