<?php

namespace Database\Seeders;

use Database\Seeders\Company\Account\AccountSeeder;
use Database\Seeders\Company\ApiService\ApiServiceTokenSeeder;
use Database\Seeders\Company\ApiService\Token\TokenTypeSeeder;
use Database\Seeders\Company\CompanySeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CompanySeeder::class);

        $this->call(ApiServiceTokenSeeder::class);

        $this->call(TokenTypeSeeder::class);

        $this->call(AccountSeeder::class);
    }
}
