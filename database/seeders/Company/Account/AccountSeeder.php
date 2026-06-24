<?php

namespace Database\Seeders\Company\Account;

use App\Models\Company\Account\Account;
use App\Models\Company\Company;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        $accounts =
            [
                ['name' => 'Основной магазин'],
                ['name' => 'Второй магазин'],
                ['name' => 'ИП Иванов WB'],
                ['name' => 'Торговый дом Ozon'],
                ['name' => 'Маркет Яндекс']
            ];

        foreach ($companies as $index => $company)
        {
            Account::query()->create(['company_id' => $company->id, 'name' => $accounts[$index]['name']]);
        }
    }
}
