<?php

namespace App\Jobs\Order;

use App\Services\Order\SyncOrderService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SyncOrderJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct
    (
        private string $dateFrom,
        private string $dateTo
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(SyncOrderService $syncOrderService): void
    {
        $syncOrderService->syncOrders(dateFrom: $this->dateFrom, dateTo: $this->dateTo);
    }
}
