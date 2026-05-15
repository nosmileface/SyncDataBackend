<?php

namespace App\Services\Income;

use App\Repositories\Income\IncomeRepository;
use App\Services\SyncClientService;

class SyncIncomeService
{
    public function __construct
    (
        private IncomeRepository    $incomeRepository,
        private SyncClientService   $syncClientService
    ){}

    public function syncIncomes(string $dateFrom, string $dateTo): int
    {
        $imported = 0;

        $page = 1;

        do
        {
            $incomes = $this->getIncomes(dateFrom: $dateFrom, dateTo: $dateTo, page: $page);

            if (empty($incomes['data']))
            {
                break;
            }

            $this->incomeRepository->upsert(data :$incomes['data']);

            $imported += count($incomes['data']);

            $page++;

        } while ($page <= $incomes['meta']['last_page']);

        return $imported;
    }

    private function getIncomes(string $dateFrom, string $dateTo, int $page): array
    {
        return $this->syncClientService->fetchIncomes(dateFrom: $dateFrom, dateTo: $dateTo, page: $page);
    }
}