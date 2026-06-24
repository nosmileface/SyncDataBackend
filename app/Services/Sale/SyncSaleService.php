<?php

namespace App\Services\Sale;

use App\Abstract\AbstractSyncService;
use App\Repositories\Sync\Sale\SaleRepository;
use App\Services\SyncClientService;

class SyncSaleService extends AbstractSyncService
{
    public function __construct
    (
        private SaleRepository      $saleRepository,
        private SyncClientService   $syncClientService
    ){}

    protected function fetch(string $dateFrom, ?string $dateTo, int $page): array
    {
        return $this->syncClientService->fetchSales
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

        $this->saleRepository->upsert(data: $data);
    }
}
