<?php

namespace App\Models\Company;

use App\Models\Company\Account\Account;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable('name')]
class Company extends Model
{
    // Relations

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }
}
