<?php

namespace App\Jobs\Sale;

use App\Services\Sale\SyncSaleService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class SyncSaleJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private int $accountId, private string $dateFrom, private string $dateTo){}

    /**
     * Execute the job.
     */
    public function handle(SyncSaleService $syncSaleService): void
    {
        try
        {
            $start = microtime(true);

            $count = $syncSaleService->sync(accountId: $this->accountId, dateFrom: $this->dateFrom, dateTo: $this->dateTo);

            $elapsed = round(microtime(true) - $start);

            Log::channel('sales')
                ->info("[SyncSales] Синхронизация завершена. Записей: {$count}. Время: {$elapsed}с.");

        } catch (\Exception $exception)
        {
            Log::channel('sales')
                ->error('[SyncSales] Ошибка синхронизации данных. Исключение: ' . $exception);
        }
    }
}
