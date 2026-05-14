<?php

namespace App\Services\Sale;

use App\Repositories\Sale\SaleRepository;
use App\Services\SyncClientService;

class SyncSaleService
{
    private const string DEFAULT_DATE_FROM = '2026-01-01';
    private const string DEFAULT_DATE_TO = '2026-05-14';

    public function __construct
    (
        private SaleRepository      $saleRepository,
        private SyncClientService   $syncClientService
    ){}

    public function syncSales(): int
    {
        $imported = 0;

        $page = 1;

        do
        {
            $sales = $this->getSales(page: $page);

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

    private function getSales(int $page): array
    {
        return $this->syncClientService->fetchSales
        (
            dateFrom: self::DEFAULT_DATE_FROM,
            dateTo: self::DEFAULT_DATE_TO,
            page: $page
        );
    }
}