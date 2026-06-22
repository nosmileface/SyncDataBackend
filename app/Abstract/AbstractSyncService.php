<?php

namespace App\Abstract;

abstract class AbstractSyncService
{
    protected int $page = 1;

    public function sync(string $dateFrom, ?string $dateTo = null): int
    {
        $imported = 0;

        do
        {
            $response = $this->fetch(dateFrom: $dateFrom, dateTo: $dateTo, page: $this->page);

            if (empty($response['data']))
            {
                break;
            }

            $this->upsert(data: $response['data']);

            $imported += count($response['data']);

            $this->page++;

        } while ($this->page <= $response['meta']['last_page']);

        return $imported;
    }

    abstract protected function upsert(array $data): void;

    abstract protected function fetch(string $dateFrom, ?string $dateTo, int $page): array;
}
