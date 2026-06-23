<?php

namespace Database\Seeders\Company;

use App\Models\Company\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies =
            [
                ['name' => 'ООО Ромашка'],
                ['name' => 'ИП Иванов'],
                ['name' => 'ООО Торговый дом'],
                ['name' => 'ЗАО Маркет'],
                ['name' => 'ООО Витрина']
            ];

        foreach ($companies as $company)
        {
            Company::query()->create($company);
        }
    }
}
