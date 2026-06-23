<?php

namespace App\Services\Order;

use App\Abstract\AbstractSyncService;
use App\Repositories\Sync\Order\OrderRepository;
use App\Services\SyncClientService;

class SyncOrderService extends AbstractSyncService
{
    public function __construct
    (
        private OrderRepository     $orderRepository,
        private SyncClientService   $syncClientService
    ){}

    protected function fetch(string $dateFrom, ?string $dateTo, int $page): array
    {
        return $this->syncClientService->fetchOrders
        (
            dateFrom: $dateFrom,
            dateTo: $dateTo,
            page: $page
        );
    }

    protected function upsert(array $data): void
    {
        $this->orderRepository->upsert(data: $data);
    }
}
