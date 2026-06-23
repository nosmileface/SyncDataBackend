<?php

namespace App\Repositories\Company\Account;

use App\Constant\Query;
use App\Models\Company\Account\Account;

class AccountRepository
{
    public function __construct(private Account $account){}

    public function getForSelect(): array
    {
        return $this->account->query()
            ->orderBy(Query::COLUMN_ID, Query::SORT_DESC)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function create(int $companyId, string $name): Account
    {
        return $this->account->query()->create(['company_id' => $companyId, 'name' => $name]);
    }
}
