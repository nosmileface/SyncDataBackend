<?php

namespace App\Console\Commands\Company;

use App\Repositories\Company\CompanyRepository;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:create-company')]
#[Description('Создать компанию.')]
class CreateCompanyCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(CompanyRepository $companyRepository): int
    {
        $name = $this->ask('Введите название компании:');

        $company = $companyRepository->create(name: $name);

        $this->info('Компания добавлена: ' . 'ID: ' . $company->id . ' | Название: ' . $company->name);

        return self::SUCCESS;
    }
}
