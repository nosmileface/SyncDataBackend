<?php

namespace App\Console\Commands;

use App\Jobs\Order\SyncOrderJob;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:sync-orders-command')]
#[Description('Команда синхронизации заказов.')]
class SyncOrdersCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        SyncOrderJob::dispatchSync();
    }
}
