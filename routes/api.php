<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1;

Route::prefix('v1')->group(function () {
    Route::middleware('throttle:60,1')->group(function () {
        Route::prefix('test')->name('get.test.')->group(function () {

            // Доходы
            Route::get('incomes', [
                V1\Test\TestController::class, 'getIncomes'
            ])->name('incomes');

            // Заказы
            Route::get('orders', [
                V1\Test\TestController::class, 'getOrders'
            ])->name('orders');

            // Продажи
            Route::get('sales', [
                V1\Test\TestController::class, 'getSales'
            ])->name('sales');

            // Склады
            Route::get('stocks', [
                V1\Test\TestController::class, 'getStocks'
            ])->name('stocks');

        });
    });
});
