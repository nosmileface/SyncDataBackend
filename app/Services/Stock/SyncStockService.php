<?php

namespace App\Services\Stock;

use App\Abstract\AbstractSyncService;
use App\Repositories\Sync\Stock\StockRepository;
use App\Services\SyncClientService;

class SyncStockService extends AbstractSyncService
{
    public function __construct
    (
        private StockRepository     $stockRepository,
        private SyncClientService   $syncClientService
    ){}

    protected function fetch(string $dateFrom, ?string $dateTo, int $page): array
    {
        return $this->syncClientService->fetchStocks
        (
            dateFrom: $dateFrom,
            page: $page
        );
    }

    protected function upsert(array $data): void
    {
        $this->stockRepository->upsert(data: $data);
    }
}
