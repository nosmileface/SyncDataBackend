<?php

namespace App\Console\Commands\Company;

use App\Repositories\Company\Account\AccountRepository;
use App\Repositories\Company\CompanyRepository;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:create-account')]
#[Description('Создать аккаунт.')]
class CreateAccountCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(CompanyRepository $companyRepository, AccountRepository $accountRepository): int
    {
        $companies = $companyRepository->getForSelect();

        $companyId = $this->choiceCompany(companies: $companies);

        $name = $this->ask('Введите название аккаунта:');

        $account = $accountRepository->create(companyId: $companyId, name: $name);

        $this->info('Аккаунт добавлен: ' . 'ID: ' . $account->id . ' | Название: ' . $account->name);

        return self::SUCCESS;
    }

    private function choiceCompany(array $companies): int
    {
        return array_search($this->choice('Выберите компанию: ', $companies), $companies);
    }
}
