<?php

namespace App\Services\Stock;

use App\Repositories\Stock\StockRepository;
use App\Services\SyncClientService;

class SyncStockService
{
    private const string DEFAULT_DATE_FROM = '2026-05-14';

    public function __construct
    (
        private StockRepository     $stockRepository,
        private SyncClientService   $syncClientService
    ){}

    public function syncStocks(): int
    {
        $imported = 0;

        $page = 1;
        do
        {
            $stocks = $this->getStocks(page: $page);

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

    private function getStocks(int $page): array
    {
        return $this->syncClientService->fetchStocks
        (
            dateFrom: self::DEFAULT_DATE_FROM,
            page: $page
        );
    }
}