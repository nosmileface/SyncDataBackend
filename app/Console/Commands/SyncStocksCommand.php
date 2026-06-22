<?php

namespace App\Console\Commands;

use App\Jobs\Stock\SyncStockJob;
use Carbon\Carbon;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

#[Signature('app:sync-stocks')]
#[Description('Команда синхронизации складов.')]
class SyncStocksCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        try
        {
            SyncStockJob::dispatch
            (
                dateFrom: Carbon::today()->toDateString()
            );

            $this->info('[SyncStocks] Задача поставлена в очередь.');

            return self::SUCCESS;
        } catch (\Exception $exception)
        {
            Log::channel('stocks')
                ->error('[SyncStocks] Ошибка постановки задачи. Исключение: ' . $exception);

            return self::FAILURE;
        }
    }
}
