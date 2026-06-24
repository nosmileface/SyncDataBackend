<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SyncClientService
{
    private const string SYNC_SALES_ENDPOINT = 'sales';
    private const string SYNC_ORDERS_ENDPOINT = 'orders';
    private const string SYNC_STOCKS_ENDPOINT = 'stocks';
    private const string SYNC_INCOMES_ENDPOINT = 'incomes';

    private const int RETRY_TIMES = 3;
    private const int RETRY_DELAY = 1000;

    public function fetchIncomes(string $dateFrom, string $dateTo, int $page): array
    {
        return $this->fetch
        (
            endpoint: self::SYNC_INCOMES_ENDPOINT,
            params:
            [
                'key' => config('sync.api_key'),
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
                'page' => $page
            ]
        );
    }

    public function fetchStocks(string $dateFrom, int $page): array
    {
        return $this->fetch
        (
            endpoint: self::SYNC_STOCKS_ENDPOINT,
            params:
            [
                'key' => config('sync.api_key'),
                'dateFrom' => $dateFrom,
                'page' => $page
            ]
        );
    }

    public function fetchOrders(string $dateFrom, string $dateTo, int $page): array
    {
        return $this->fetch
        (
            endpoint: self::SYNC_ORDERS_ENDPOINT,
            params:
            [
                'key' => config('sync.api_key'),
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
                'page' => $page
            ]
        );
    }

    public function fetchSales(string $dateFrom, string $dateTo, int $page): array
    {
        return $this->fetch
        (
            endpoint: self::SYNC_SALES_ENDPOINT,
            params:
            [
                'key' => config('sync.api_key'),
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
                'page' => $page
            ]
        );
    }

    private function fetch(string $endpoint, array $params = []): array
    {
        $response = Http::retry(self::RETRY_TIMES, self::RETRY_DELAY)
            ->get(config('sync.api_url') . ':' . config('sync.api_port') . '/api/' . $endpoint, $params);

        if (!$response->successful())
        {
            return [];
        }

        return $response->json();
    }
}
