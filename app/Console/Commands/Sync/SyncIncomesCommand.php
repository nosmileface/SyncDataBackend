<?php

namespace App\Console\Commands\Sync;

use App\Jobs\Income\SyncIncomeJob;
use App\Repositories\Company\Account\AccountRepository;
use App\Repositories\Sync\Income\IncomeRepository;
use Carbon\Carbon;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

#[Signature('app:sync-incomes')]
#[Description('Команда синхронизации доходов.')]
class SyncIncomesCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(IncomeRepository $incomeRepository, AccountRepository $accountRepository): int
    {
        try
        {
            $this->addDispatch(incomeRepository: $incomeRepository, accounts: $accountRepository->getAll());

            $this->info('[SyncIncomes] Задача поставлена в очередь.');

            return self::SUCCESS;

        } catch (\Exception $exception)
        {
            Log::channel('incomes')
                ->error('[SyncIncomes] Ошибка постановки задачи. Исключение: ' . $exception);

            return self::FAILURE;
        }
    }

    private function addDispatch(IncomeRepository $incomeRepository, Collection $accounts): void
    {
        foreach ($accounts as $account)
        {
            SyncIncomeJob::dispatch
            (
                accountId: $account->id,
                dateFrom: $this->getLastDate(incomeRepository: $incomeRepository, accountId: $account->id),
                dateTo: Carbon::today()->toDateString()
            );
        }
    }

    private function getLastDate(IncomeRepository $incomeRepository, int $accountId): string
    {
        return $incomeRepository->getLastDate(accountId: $accountId);
    }
}
