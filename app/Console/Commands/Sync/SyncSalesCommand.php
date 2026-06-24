<?php

namespace App\Console\Commands\Sync;

use App\Jobs\Sale\SyncSaleJob;
use App\Repositories\Company\Account\AccountRepository;
use App\Repositories\Sync\Sale\SaleRepository;
use Carbon\Carbon;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

#[Signature('app:sync-sales')]
#[Description('Команда синхронизации продаж.')]
class SyncSalesCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(SaleRepository $saleRepository, AccountRepository $accountRepository): int
    {
        try
        {
            $this->addDispatch(saleRepository: $saleRepository, accounts: $accountRepository->getAll());

            $this->info('[SyncSales] Задача поставлена в очередь.');

            return self::SUCCESS;
        } catch (\Exception $exception)
        {
            Log::channel('sales')
                ->error('[SyncSales] Ошибка постановки задачи. Исключение: ' . $exception);

            return self::FAILURE;
        }
    }

    private function addDispatch(SaleRepository $saleRepository, Collection $accounts): void
    {
        foreach ($accounts as $account)
        {
            SyncSaleJob::dispatch
            (
                accountId: $account->id,
                dateFrom: $this->getLastDate(saleRepository: $saleRepository, accountId: $account->id),
                dateTo: Carbon::today()->toDateString()
            );
        }
    }

    private function getLastDate(SaleRepository $saleRepository, int $accountId): string
    {
        return $saleRepository->getLastDate(accountId: $accountId);
    }
}
