<?php

namespace App\Models\Company\ApiService;

use App\Models\Company\ApiService\Token\TokenType;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'type'])]
class ApiService extends Model
{
    // Relations

    public function tokenTypes(): HasMany
    {
        return $this->hasMany(TokenType::class);
    }
}
