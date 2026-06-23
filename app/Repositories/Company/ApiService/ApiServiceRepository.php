<?php

namespace App\Repositories\Company\ApiService;

use App\Constant\Query;
use App\Models\Company\ApiService\ApiService;

class ApiServiceRepository
{
    public function __construct(private ApiService $apiService){}

    public function getForSelect(): array
    {
        return $this->apiService->query()
            ->orderBy(Query::COLUMN_ID, Query::SORT_DESC)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function create(string $name, string $type): ApiService
    {
        return $this->apiService->query()->create(['name' => $name, 'type' => $type]);
    }
}
