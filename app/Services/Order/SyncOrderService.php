<?php

namespace App\Services\Order;

use App\Repositories\Order\OrderRepository;
use App\Services\SyncClientService;

class SyncOrderService
{
    public function __construct
    (
        private OrderRepository     $orderRepository,
        private SyncClientService   $syncClientService
    ){}

    public function syncOrders(string $dateFrom, string $dateTo): int
    {
        $imported = 0;

        $page = 1;

        do
        {
            $orders = $this->getOrders(dateFrom: $dateFrom, dateTo: $dateTo, page: $page);

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

    private function getOrders(string $dateFrom, string $dateTo, int $page): array
    {
        return $this->syncClientService->fetchOrders(dateFrom: $dateFrom, dateTo: $dateTo, page: $page);
    }
}