<?php

namespace App\Models\Company\Account;

use App\Models\Company\Company;
use App\Models\Sync\Income\Income;
use App\Models\Sync\Order\Order;
use App\Models\Sync\Sale\Sale;
use App\Models\Sync\Stock\Stock;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['company_id', 'name'])]
class Account extends Model
{
    // Relations

    public function incomes(): HasMany
    {
        return $this->hasMany(Income::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function accountToken(): HasMany
    {
        return $this->hasMany(AccountToken::class);
    }
}
