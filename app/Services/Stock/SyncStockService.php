<?php

namespace App\Services\Stock;

use App\Repositories\Stock\StockRepository;
use App\Services\SyncClientService;

class SyncStockService
{
    public function __construct
    (
        private StockRepository     $stockRepository,
        private SyncClientService   $syncClientService
    ){}

    public function syncStocks(string $dateFrom): int
    {
        $imported = 0;

        $page = 1;
        do
        {
            $stocks = $this->getStocks(dateFrom: $dateFrom, page: $page);

            if (empty($stocks['data']))
            {
                break;
            }

            $this->stockRepository->upsert(data: $stocks['data']);

            $imported += count($stocks['data']);

            $page++;

        } while ($page <= $stocks['meta']['last_page']);

        return $imported;
    }

    private function getStocks(string $dateFrom, int $page): array
    {
        return $this->syncClientService->fetchStocks(dateFrom: $dateFrom, page: $page);
    }
}