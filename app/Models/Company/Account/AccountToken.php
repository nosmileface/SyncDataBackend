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
        'api_token',
        'bearer',
        'login',
        'password',
        'access_token',
        'refresh_token',
        'expires_at'
    ]
)]

class AccountToken extends Model
{
    protected $casts = [
        'api_token' => 'encrypted',
        'bearer' => 'encrypted',
        'password' => 'encrypted',
        'access_token' => 'encrypted',
        'refresh_token' => 'encrypted'
    ];

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
