<?php

namespace App\Models\Sync\Order;

use App\Models\Company\Account\Account;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable
(
    [
        'account_id',
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
    // Relations

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
