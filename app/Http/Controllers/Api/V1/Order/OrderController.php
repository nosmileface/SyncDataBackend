<?php

namespace App\Http\Controllers\Api\V1\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\IndexRequest;
use App\Repositories\Sync\Order\OrderRepository;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function __construct(private OrderRepository $orderRepository){}

    public function getOrders(int $accountId, IndexRequest $indexRequest): JsonResponse
    {
        $orders = $this->orderRepository->getAll(accountId: $accountId, filters: $indexRequest->validated());

        return response()->json(['data' => $orders->items()]);
    }
}
