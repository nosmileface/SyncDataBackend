<?php

namespace Database\Seeders\Company\ApiService;

use App\Models\Company\ApiService\ApiService;
use Illuminate\Database\Seeder;

class ApiServiceTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apiServices =
            [
                ['name' => 'Wildberries',   'type' => 'wildberries'],
                ['name' => 'Ozon',          'type' => 'ozon'],
                ['name' => 'Yandex Market', 'type' => 'yandex_market'],
                ['name' => 'Lamoda',        'type' => 'lamoda'],
                ['name' => 'Avito',         'type' => 'avito']
            ];

        foreach ($apiServices as $apiService)
        {
            ApiService::query()->create($apiService);
        }
    }
}
