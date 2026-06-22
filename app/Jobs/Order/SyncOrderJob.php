<?php

namespace App\Jobs\Order;

use App\Services\Order\SyncOrderService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class SyncOrderJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private string $dateFrom, private string $dateTo){}

    /**
     * Execute the job.
     */
    public function handle(SyncOrderService $syncOrderService): void
    {
        try
        {
            $start = microtime(true);

            $count = $syncOrderService->sync(dateFrom: $this->dateFrom, dateTo: $this->dateTo);

            $elapsed = round(microtime(true) - $start);

            Log::channel('orders')
                ->info("[SyncOrders] Синхронизация завершена. Записей: {$count}. Время: {$elapsed}с.");

        } catch (\Exception $exception)
        {
            Log::channel('orders')
                ->error('[SyncOrders] Ошибка синхронизации данных. Исключение: ' . $exception);
        }
    }
}
