<?php

namespace App\Http\Controllers\Api\V1\Stock;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\IndexRequest;
use App\Repositories\Sync\Stock\StockRepository;
use Illuminate\Http\JsonResponse;

class StockController extends Controller
{
    public function __construct(private StockRepository $stockRepository){}

    public function getStocks(int $accountId, IndexRequest $indexRequest): JsonResponse
    {
        $stocks = $this->stockRepository->getAll(accountId: $accountId, filters: $indexRequest->validated());

        return response()->json(['data' => $stocks->items()]);
    }
}
