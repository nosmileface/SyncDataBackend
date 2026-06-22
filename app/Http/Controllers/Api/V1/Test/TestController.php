<?php

namespace App\Http\Controllers\Api\V1\Test;

use App\Http\Controllers\Controller;
use App\Services\Income\SyncIncomeService;
use App\Services\Order\SyncOrderService;
use App\Services\Sale\SyncSaleService;
use App\Services\Stock\SyncStockService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class TestController extends Controller
{
    public function __construct
    (
        private SyncIncomeService   $syncIncomeService,
        private SyncOrderService    $syncOrderService,
        private SyncSaleService     $syncSaleService,
        private SyncStockService    $syncStockService
    ){}

    public function getIncomes(): JsonResponse
    {
        $incomes = $this->syncIncomeService->sync
        (
            dateFrom: Carbon::today()->startOfMonth()->startOfYear()->toDateString(),
            dateTo: Carbon::today()->toDateString()
        );

        return response()->json
        (
            [
                'message' => 'Данные о доходах получены. Количество: ' . $incomes . ' записей.'
            ]
        );
    }

    public function getOrders(): JsonResponse
    {
        $orders = $this->syncOrderService->sync
        (
            dateFrom: Carbon::today()->startOfMonth()->toDateString(),
            dateTo: Carbon::today()->toDateString()
        );

        return response()->json
        (
            [
                'message' => 'Данные о заказах получены. Количество: ' . $orders . ' записей.'
            ]
        );
    }

    public function getSales(): JsonResponse
    {
        $sales = $this->syncSaleService->sync
        (
            dateFrom: Carbon::today()->startOfMonth()->toDateString(),
            dateTo: Carbon::today()->toDateString()
        );

        return response()->json
        (
            [
                'message' => 'Данные о продажах получены. Количество: ' . $sales . ' записей.'
            ]
        );
    }

    public function getStocks(): JsonResponse
    {
        $stocks = $this->syncStockService->sync
        (
            dateFrom: Carbon::today()->toDateString()
        );

        return response()->json
        (
            [
                'message' => 'Данные о складах получены. Количество: ' . $stocks . ' записей.'
            ]
        );
    }
}
