<?php

namespace App\Jobs\Order;

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
    public function handle(SyncSaleService $syncSaleService): void
    {
        try
        {
            $start = microtime(true);

            $sales = $syncSaleService->syncSales(dateFrom: $this->dateFrom, dateTo: $this->dateTo);

            $end = microtime(true);

            Log::channel('sales')
                ->info('[SyncSales] Данные о продажах получены. Количество: ' . $sales . ' записей. Затрачено времени: ' . round($end - $start) . 'c.');

        } catch (\Exception $exception)
        {
            Log::channel('sales')
                ->error('[SyncSales] Ошибка синхронизации данных. Исключение: ' . $exception);
        }
    }
}
