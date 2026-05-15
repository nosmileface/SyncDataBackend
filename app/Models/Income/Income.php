<?php

namespace App\Models\Income;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable
(
    [
        'income_id',
        'date',
        'last_change_date',
        'date_close',
        'nm_id',
        'barcode',
        'supplier_article',
        'tech_size',
        'warehouse_name',
        'number',
        'total_price',
        'quantity'
    ]
)]
class Income extends Model
{
    //
}
