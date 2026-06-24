<?php

namespace App\Http\Controllers\Api\V1\Income;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\IndexRequest;
use App\Repositories\Sync\Income\IncomeRepository;
use Illuminate\Http\JsonResponse;

class IncomeController extends Controller
{
    public function __construct(private IncomeRepository $incomeRepository){}

    public function getIncomes(int $accountId, IndexRequest $indexRequest): JsonResponse
    {
        $incomes = $this->incomeRepository->getAll(accountId: $accountId, filters: $indexRequest->validated());

        return response()->json(['data' => $incomes->items()]);
    }
}
