<?php

namespace App\Models\Sync\Income;

use App\Models\Company\Account\Account;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable
(
    [
        'account_id',
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
    // Relations

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
