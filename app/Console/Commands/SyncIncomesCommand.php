<?php

namespace App\Console\Commands;

use App\Jobs\Order\SyncIncomeJob;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:sync-incomes-command')]
#[Description('Команда синхронизации доходов.')]
class SyncIncomesCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        SyncIncomeJob::dispatchSync();
    }
}
