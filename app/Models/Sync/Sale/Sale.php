<?php

namespace App\Models\Sync\Sale;

use App\Models\Company\Account\Account;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable
(
    [
        'account_id',
        'g_number',
        'sale_id',
        'income_id',
        'odid',
        'date',
        'last_change_date',
        'nm_id',
        'barcode',
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
)]
class Sale extends Model
{
    // Relations

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
