<?php

namespace App\Models\Sync\Stock;

use App\Models\Company\Account\Account;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable
(
    [
        'account_id',
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
    // Relations

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
