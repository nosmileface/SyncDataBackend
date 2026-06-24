<?php

namespace App\Console\Commands\Sync;

use App\Jobs\Stock\SyncStockJob;
use App\Repositories\Company\Account\AccountRepository;
use App\Repositories\Sync\Stock\StockRepository;
use Carbon\Carbon;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

#[Signature('app:sync-stocks')]
#[Description('Команда синхронизации складов.')]
class SyncStocksCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(StockRepository $stockRepository, AccountRepository $accountRepository): int
    {
        try
        {
            $this->addDispatch(stockRepository: $stockRepository, accounts: $accountRepository->getAll());

            $this->info('[SyncStocks] Задача поставлена в очередь.');

            return self::SUCCESS;
        } catch (\Exception $exception)
        {
            Log::channel('stocks')
                ->error('[SyncStocks] Ошибка постановки задачи. Исключение: ' . $exception);

            return self::FAILURE;
        }
    }

    private function addDispatch(StockRepository $stockRepository, Collection $accounts): void
    {
        foreach ($accounts as $account)
        {
            SyncStockJob::dispatch
            (
                accountId: $account->id,
                dateFrom: $this->getLastDate(stockRepository: $stockRepository, accountId: $account->id)
            );
        }
    }

    private function getLastDate(StockRepository $stockRepository, int $accountId): string
    {
        return $stockRepository->getLastDate(accountId: $accountId);
    }
}
