<?php

namespace App\Models\Company\Account;

use App\Models\Company\Company;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['company_id', 'name'])]
class Account extends Model
{
    // Relations

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function accountToken(): HasMany
    {
        return $this->hasMany(AccountToken::class);
    }
}
