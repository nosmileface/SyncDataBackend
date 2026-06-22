<?php

namespace App\Models\Company\ApiService\Token;

use App\Models\Company\Account\AccountToken;
use App\Models\Company\ApiService\ApiService;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['api_service_id', 'name', 'type'])]
class TokenType extends Model
{
    // Relations

    public function tokens(): HasMany
    {
        return $this->hasMany(AccountToken::class);
    }

    public function apiService(): BelongsTo
    {
        return $this->belongsTo(ApiService::class);
    }
}
