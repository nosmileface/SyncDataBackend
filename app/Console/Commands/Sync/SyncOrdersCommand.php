<?php

namespace App\Console\Commands\Sync;

use App\Jobs\Order\SyncOrderJob;
use App\Repositories\Company\Account\AccountRepository;
use App\Repositories\Sync\Order\OrderRepository;
use Carbon\Carbon;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

#[Signature('app:sync-orders')]
#[Description('Команда синхронизации заказов.')]
class SyncOrdersCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(OrderRepository $orderRepository, AccountRepository $accountRepository): int
    {
        try
        {
            $this->addDispatch(orderRepository: $orderRepository, accounts: $accountRepository->getAll());

            $this->info('[SyncOrders] Задача поставлена в очередь.');

            return self::SUCCESS;

        } catch (\Exception $exception)
        {
            Log::channel('orders')
                ->error('[SyncOrders] Ошибка постановки задачи. Исключение: ' . $exception);

            return self::FAILURE;
        }
    }

    private function addDispatch(OrderRepository $orderRepository, Collection $accounts): void
    {
        foreach ($accounts as $account)
        {
            SyncOrderJob::dispatch
            (
                accountId: $account->id,
                dateFrom: $this->getLastDate(orderRepository: $orderRepository, accountId: $account->id),
                dateTo: Carbon::today()->toDateString()
            );
        }
    }

    private function getLastDate(OrderRepository $orderRepository, int $accountId): string
    {
        return $orderRepository->getLastDate(accountId: $accountId);
    }
}
