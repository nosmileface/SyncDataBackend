<?php

namespace App\Jobs\Stock;

use App\Services\Stock\SyncStockService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class SyncStockJob implements ShouldQueue
{
    use Queueable;

    public function __construct(private int $accountId, private string $dateFrom){}

    public function handle(SyncStockService $syncStockService): void
    {
        try
        {
            $start = microtime(true);

            $count = $syncStockService->sync(accountId: $this->accountId, dateFrom: $this->dateFrom);

            $elapsed = round(microtime(true) - $start);

            Log::channel('stocks')
                ->info("[SyncStocks] Синхронизация завершена. Записей: {$count}. Время: {$elapsed}с.");

        } catch (\Exception $exception)
        {
            Log::channel('stocks')
                ->error('[SyncStocks] Ошибка синхронизации данных. Исключение: ' . $exception);
        }
    }
}
