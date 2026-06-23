<?php

namespace App\Console\Commands\Sync;

use App\Jobs\Sale\SyncSaleJob;
use App\Repositories\Company\Account\AccountRepository;
use Carbon\Carbon;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

#[Signature('app:sync-sales')]
#[Description('Команда синхронизации продаж.')]
class SyncSalesCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(AccountRepository $accountRepository): int
    {
        try
        {
            $accounts = $accountRepository->getForSelect();

            $accountId = $this->choiceAccounts(accounts: $accounts);

            SyncSaleJob::dispatchSync
            (
                accountId: $accountId,
                dateFrom: Carbon::today()->startOfMonth()->toDateString(),
                dateTo: Carbon::today()->toDateString()
            );

            $this->info('[SyncSales] Задача поставлена в очередь.');

            return self::SUCCESS;
        } catch (\Exception $exception)
        {
            Log::channel('sales')
                ->error('[SyncSales] Ошибка постановки задачи. Исключение: ' . $exception);

            return self::FAILURE;
        }
    }

    private function choiceAccounts(array $accounts): int
    {
        return array_search($this->choice('Выберите аккаунт:', $accounts), $accounts);
    }
}
