<?php

namespace App\Jobs\Order;

use App\Services\Stock\SyncStockService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SyncStockJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(SyncStockService $syncStockService): void
    {
        $syncStockService->syncStocks();
    }
}
