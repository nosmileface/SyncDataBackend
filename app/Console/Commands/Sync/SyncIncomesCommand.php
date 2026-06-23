<?php

namespace App\Console\Commands\Sync;

use App\Jobs\Income\SyncIncomeJob;
use Carbon\Carbon;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

#[Signature('app:sync-incomes')]
#[Description('Команда синхронизации доходов.')]
class SyncIncomesCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        try
        {
            SyncIncomeJob::dispatch(
                dateFrom: Carbon::today()->startOfYear()->toDateString(),
                dateTo: Carbon::today()->toDateString()
            );

            $this->info('[SyncIncomes] Задача поставлена в очередь.');

            return self::SUCCESS;

        } catch (\Exception $exception)
        {
            Log::channel('incomes')
                ->error('[SyncIncomes] Ошибка постановки задачи. Исключение: ' . $exception);

            return self::FAILURE;
        }
    }
}
