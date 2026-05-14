<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable
(
    [
        'sc_code',
        'date',
        'last_change_date',
        'nm_id',
        'barcode',
        'supplier_article',
        'tech_size',
        'subject',
        'category',
        'brand',
        'warehouse_name',
        'in_way_to_client',
        'in_way_from_client',
        'price',
        'discount',
        'quantity',
        'quantity_full',
        'is_supply',
        'is_realization'
    ]
)]
class Stock extends Model
{
    //
}
