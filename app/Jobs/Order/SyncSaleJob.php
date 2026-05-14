<?php

namespace App\Jobs\Order;

use App\Services\Sale\SyncSaleService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SyncSaleJob implements ShouldQueue
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
    public function handle(SyncSaleService $syncSaleService): void
    {
        $syncSaleService->syncSales();
    }
}
