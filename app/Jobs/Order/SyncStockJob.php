<?php

namespace App\Jobs\Order;

use App\Services\Stock\SyncStockService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class SyncStockJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct
    (
        private string $dateFrom
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(SyncStockService $syncStockService): void
    {

        $stocks = $syncStockService->syncStocks(dateFrom: $this->dateFrom);

        Log::channel('stocks')
            ->info('[SyncStocks] Данные о складах получены. Количество: ' . $stocks . ' записей.');
    }
}
