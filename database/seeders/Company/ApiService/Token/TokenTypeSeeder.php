<?php

namespace Database\Seeders\Company\ApiService\Token;

use App\Models\Company\ApiService\ApiService;
use App\Models\Company\ApiService\Token\TokenType;
use Illuminate\Database\Seeder;

class TokenTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apiServices = ApiService::all();

        $tokenTypes =
            [
                ['name' => 'Statistics API', 'type' => 'api_key'],
                ['name' => 'Seller API',     'type' => 'api_key'],
                ['name' => 'Market API',     'type' => 'oauth'],
                ['name' => 'Partner API',    'type' => 'bearer'],
                ['name' => 'Avito API',      'type' => 'login_password']
            ];

        foreach ($apiServices as $index => $apiService)
        {
            TokenType::query()->create([
                'api_service_id' => $apiService->id,
                'name' => $tokenTypes[$index]['name'],
                'type' => $tokenTypes[$index]['type'],
            ]);
        }
    }
}
