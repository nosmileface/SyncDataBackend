<?php

namespace App\Console\Commands\Sync;

use App\Jobs\Order\SyncOrderJob;
use Carbon\Carbon;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

#[Signature('app:sync-orders')]
#[Description('Команда синхронизации заказов.')]
class SyncOrdersCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        try
        {
            SyncOrderJob::dispatch
            (
                dateFrom: Carbon::today()->startOfMonth()->toDateString(),
                dateTo: Carbon::today()->toDateString()
            );

            $this->info('[SyncOrders] Задача поставлена в очередь.');

            return self::SUCCESS;

        } catch (\Exception $exception)
        {
            Log::channel('orders')
                ->error('[SyncOrders] Ошибка постановки задачи. Исключение: ' . $exception);

            return self::FAILURE;
        }
    }
}
