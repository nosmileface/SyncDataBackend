<?php

namespace App\Services\Income;

use App\Repositories\Income\IncomeRepository;
use App\Services\SyncClientService;

class SyncIncomeService
{
    private const string DEFAULT_DATE_FROM = '2026-01-01';
    private const string DEFAULT_DATE_TO = '2026-05-14';

    public function __construct
    (
        private IncomeRepository    $incomeRepository,
        private SyncClientService   $syncClientService
    ){}

    public function syncIncomes(): int
    {
        $imported = 0;

        $page = 1;

        do
        {
            $incomes = $this->getIncomes(page: $page);

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

    private function getIncomes(int $page): array
    {
        return $this->syncClientService->fetchIncomes
        (
            dateFrom: self::DEFAULT_DATE_FROM,
            dateTo: self::DEFAULT_DATE_TO,
            page: $page
        );
    }
}