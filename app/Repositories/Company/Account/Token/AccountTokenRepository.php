<?php

namespace App\Repositories\Company\Account\Token;

use App\Models\Company\Account\Account;
use App\Models\Company\Account\AccountToken;
use App\Models\Company\ApiService\Token\TokenType;

class AccountTokenRepository
{
    public function __construct(private AccountToken $accountToken){}

    public function updateOrCreate(Account $account, TokenType $tokenType, array $token): AccountToken
    {
        return $this->accountToken->query()->updateOrCreate
        (
            [
                'account_id'    => $account->id,
                'token_type_id' => $tokenType->id
            ],
            [
                'token' => $token
            ]
        );
    }
}
