<?php

namespace App\Console\Commands;

use App\Jobs\Order\SyncSaleJob;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:sync-sales-command')]
#[Description('Команда синхронизации продаж.')]
class SyncSalesCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        SyncSaleJob::dispatchSync();
    }
}
