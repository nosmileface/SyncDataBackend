<?php

namespace App\Console\Commands;

use App\Jobs\Order\SyncStockJob;
use Carbon\Carbon;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:sync-stocks-command')]
#[Description('Команда синхронизации складов.')]
class SyncStocksCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        SyncStockJob::dispatchSync
        (
            dateFrom: Carbon::today()->toDateString()
        );
    }
}
