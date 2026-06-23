<?php

namespace App\Repositories\Company\ApiService\Token;

use App\Constant\Query;
use App\Models\Company\ApiService\Token\TokenType;

class TokenTypeRepository
{
    public function __construct(private TokenType $tokenType){}

    public function getForSelect(): array
    {
        return $this->tokenType->query()
            ->orderBy(Query::COLUMN_ID, Query::SORT_DESC)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function findById(int $tokenTypeId): TokenType
    {
        return $this->tokenType->query()->findOrFail($tokenTypeId);
    }

    public function create(int $apiServiceId, string $name, string $type): TokenType
    {
        return $this->tokenType->query()->create(['api_service_id' => $apiServiceId, 'name' => $name, 'type' => $type]);
    }
}
