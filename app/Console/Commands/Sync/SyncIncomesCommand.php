<?php

namespace App\Console\Commands\Sync;

use App\Jobs\Income\SyncIncomeJob;
use App\Repositories\Company\Account\AccountRepository;
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
    public function handle(AccountRepository $accountRepository): int
    {
        try
        {
            $accounts = $accountRepository->getForSelect();

            $accountId = $this->choiceAccounts(accounts: $accounts);

            SyncIncomeJob::dispatchSync
            (
                accountId: $accountId,
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

    private function choiceAccounts(array $accounts): int
    {
        return array_search($this->choice('Выберите аккаунт:', $accounts), $accounts);
    }
}
