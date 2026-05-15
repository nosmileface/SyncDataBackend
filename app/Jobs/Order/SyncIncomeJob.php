<?php

namespace App\Jobs\Order;

use App\Services\Income\SyncIncomeService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SyncIncomeJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct
    (
        private string $dateFrom,
        private string $dateTo
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(SyncIncomeService $syncIncomeService): void
    {
        $syncIncomeService->syncIncomes(dateFrom: $this->dateFrom, dateTo: $this->dateTo);
    }
}
