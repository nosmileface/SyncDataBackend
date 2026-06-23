<?php

namespace App\Services\Income;

use App\Abstract\AbstractSyncService;
use App\Repositories\Sync\Income\IncomeRepository;
use App\Services\SyncClientService;

class SyncIncomeService extends AbstractSyncService
{
    public function __construct
    (
        private IncomeRepository    $incomeRepository,
        private SyncClientService   $syncClientService
    ){}

    protected function fetch(string $dateFrom, ?string $dateTo, int $page): array
    {
        return $this->syncClientService->fetchIncomes
        (
            dateFrom: $dateFrom,
            dateTo: $dateTo,
            page: $page
        );
    }

    protected function upsert(int $accountId, array $data): void
    {
        foreach ($data as &$item)
        {
            $item['account_id'] = $accountId;
        }

        $this->incomeRepository->upsert(data: $data);
    }
}
