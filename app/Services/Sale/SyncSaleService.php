<?php

namespace App\Services\Sale;

use App\Repositories\Sale\SaleRepository;
use App\Services\SyncClientService;

class SyncSaleService
{
    public function __construct
    (
        private SaleRepository      $saleRepository,
        private SyncClientService   $syncClientService
    ){}

    public function syncSales(string $dateFrom, string $dateTo): int
    {
        $imported = 0;

        $page = 1;

        do
        {
            $sales = $this->getSales(dateFrom: $dateFrom, dateTo: $dateTo, page: $page);

            if (empty($sales['data']))
            {
                break;
            }

            $this->saleRepository->upsert(data: $sales['data']);

            $imported += count($sales['data']);

            $page++;

        } while ($page <= $sales['meta']['last_page']);

        return $imported;
    }

    private function getSales(string $dateFrom, string $dateTo, int $page): array
    {
        return $this->syncClientService->fetchSales(dateFrom: $dateFrom, dateTo: $dateTo, page: $page);
    }
}