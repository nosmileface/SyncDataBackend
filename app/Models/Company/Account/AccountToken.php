<?php

namespace App\Models\Company\Account;

use App\Models\Company\ApiService\Token\TokenType;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable
(
    [
        'account_id',
        'token_type_id',
        'token'
    ]
)]

class AccountToken extends Model
{
    protected $casts = ['token' => 'encrypted:array'];

    // Relations

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function tokenType(): BelongsTo
    {
        return $this->belongsTo(TokenType::class);
    }
}
