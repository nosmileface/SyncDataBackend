<?php

namespace App\Http\Controllers\Api\V1\Sale;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\IndexRequest;
use App\Repositories\Sync\Sale\SaleRepository;
use Illuminate\Http\JsonResponse;

class SaleController extends Controller
{
    public function __construct(private SaleRepository $saleRepository){}

    public function getSales(int $accountId, IndexRequest $indexRequest): JsonResponse
    {
        $sales = $this->saleRepository->getAll(accountId: $accountId, filters: $indexRequest->validated());

        return response()->json(['data' => $sales->items()]);
    }
}
