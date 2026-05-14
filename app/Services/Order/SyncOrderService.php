<?php

namespace App\Services\Order;

use App\Repositories\Order\OrderRepository;
use App\Services\SyncClientService;

class SyncOrderService
{
    private const string DEFAULT_DATE_FROM = '2026-01-01';
    private const string DEFAULT_DATE_TO = '2026-05-14';

    public function __construct
    (
        private OrderRepository     $orderRepository,
        private SyncClientService   $syncClientService
    ){}

    public function syncOrders(): int
    {
        $imported = 0;

        $page = 1;

        do
        {
            $orders = $this->getOrders(page: $page);

            if (empty($orders['data']))
            {
                break;
            }

            $this->orderRepository->upsert(data: $orders['data']);

            $imported += count($orders['data']);

            $page++;

        } while ($page <= $orders['meta']['last_page']);

        return $imported;
    }

    private function getOrders(int $page): array
    {
        return $this->syncClientService->fetchOrders
        (
            dateFrom: self::DEFAULT_DATE_FROM,
            dateTo: self::DEFAULT_DATE_TO,
            page: $page
        );
    }
}