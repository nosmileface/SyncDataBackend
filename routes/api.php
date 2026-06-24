<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1;

Route::prefix('v1')->group(function () {
    Route::middleware('throttle:60,1')->group(function () {
        // Доходы
        Route::get('{accountId}/incomes', [
            V1\Income\IncomeController::class, 'getIncomes'
        ])->name('incomes');

        // Заказы
        Route::get('{accountId}/orders', [
            V1\Order\OrderController::class, 'getOrders'
        ])->name('orders');

        // Продажи
        Route::get('{accountId}/sales', [
            V1\Sale\SaleController::class, 'getSales'
        ])->name('sales');

        // Склады
        Route::get('{accountId}/stocks', [
            V1\Stock\StockController::class, 'getStocks'
        ])->name('stocks');
    });
});
