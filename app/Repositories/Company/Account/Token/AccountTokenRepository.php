<?php

namespace App\Repositories\Company\Account\Token;

use App\Models\Company\Account\AccountToken;

class AccountTokenRepository
{
    public function __construct(private AccountToken $accountToken){}

    public function updateOrCreate(int $accountId, int $tokenTypeId, array $token): AccountToken
    {
        return $this->accountToken->query()->updateOrCreate
        (
            [
                'account_id'    => $accountId,
                'token_type_id' => $tokenTypeId
            ],
            [
                'token' => $token
            ]
        );
    }
}
