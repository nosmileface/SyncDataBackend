<?php

namespace App\Jobs\Income;

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
    public function __construct(private string $dateFrom, private string $dateTo){}

    /**
     * Execute the job.
     */
    public function handle(SyncIncomeService $syncIncomeService): void
    {
        try
        {
            $start = microtime(true);

            $count = $syncIncomeService->sync(dateFrom: $this->dateFrom, dateTo: $this->dateTo);

            $elapsed = round(microtime(true) - $start);

            Log::channel('incomes')
                ->info("[SyncIncomes] Синхронизация завершена. Записей: {$count}. Время: {$elapsed}с.");

        } catch (\Exception $exception)
        {
            Log::channel('incomes')
                ->error('[SyncIncomes] Ошибка синхронизации. Исключение: ' . $exception);
        }
    }
}
