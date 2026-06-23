<?php

namespace App\Repositories\Company;

use App\Constant\Query;
use App\Models\Company\Company;

class CompanyRepository
{
    public function __construct(private Company $company){}

    public function getForSelect(): array
    {
        return $this->company->query()
            ->orderBy(Query::COLUMN_ID, Query::SORT_DESC)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function findById(int $id): Company
    {
        return $this->company->query()->findOrFail($id);
    }

    public function create(string $name): Company
    {
        return $this->company->query()->create(['name' => $name]);
    }
}
