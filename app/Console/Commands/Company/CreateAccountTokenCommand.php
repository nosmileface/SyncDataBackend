<?php

namespace App\Console\Commands\Company;

use App\Repositories\Company\Account\AccountRepository;
use App\Repositories\Company\Account\Token\AccountTokenRepository;
use App\Repositories\Company\ApiService\Token\TokenTypeRepository;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:create-account-token')]
#[Description('Создать токен акканута.')]
class CreateAccountTokenCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle
    (
        AccountRepository       $accountRepository,
        AccountTokenRepository  $accountTokenRepository,
        TokenTypeRepository     $tokenTypeRepository

    ): int
    {
        $accounts = $accountRepository->getForSelect();

        $accountId = $this->choiceAccounts(accounts: $accounts);

        $tokenTypes = $tokenTypeRepository->getForSelect();

        $tokenTypesId = $this->choiceTokenType(tokenTypes: $tokenTypes);

        $account = $accountRepository->findById(accountId: $accountId);

        $tokenType = $tokenTypeRepository->findById(tokenTypeId: $tokenTypesId);

        $token = ['api_token' => $this->secret('Введите токен:')];

        $accountToken = $accountTokenRepository->updateOrCreate(account: $account, tokenType: $tokenType, token: $token);

        $this->info('Токен добавлен: ID: ' . $accountToken->id);

        return self::SUCCESS;
    }

    private function choiceTokenType(array $tokenTypes): int
    {
        return array_search($this->choice('Выберите тип токена: ', $tokenTypes), $tokenTypes);
    }

    private function choiceAccounts(array $accounts): int
    {
        return array_search($this->choice('Выберите аккаунт: ', $accounts), $accounts);
    }
}
