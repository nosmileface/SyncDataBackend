<?php

namespace App\Jobs\Order;

use App\Services\Income\SyncIncomeService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class SyncIncomeJob implements ShouldQueue
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
    public function handle(SyncIncomeService $syncIncomeService): void
    {
        try
        {
            $start = microtime(true);

            $incomes = $syncIncomeService->syncIncomes(dateFrom: $this->dateFrom, dateTo: $this->dateTo);

            $end = microtime(true);

            Log::channel('incomes')
                ->info('[SyncIncomes] Данные о доходах получены. Количество: ' . $incomes . ' записей. Затрачено времени: ' . round($end - $start) . 'c.');

        } catch (\Exception $exception)
        {
            Log::channel('incomes')
                ->error('[SyncIncomes] Ошибка синхронизации данных. Исключение: ' . $exception);
        }
    }
}
