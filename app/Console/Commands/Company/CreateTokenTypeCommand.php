<?php

namespace App\Console\Commands\Company;

use App\Repositories\Company\ApiService\ApiServiceRepository;
use App\Repositories\Company\ApiService\Token\TokenTypeRepository;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

#[Signature('app:create-token-type')]
#[Description('Создать тип токена.')]
class CreateTokenTypeCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(ApiServiceRepository $apiServiceRepository, TokenTypeRepository $tokenTypeRepository): int
    {
        $apiServices = $apiServiceRepository->getForSelect();

        $apiServiceId = $this->choiceApiServices(apiServices: $apiServices);

        $name = $this->ask('Введите название типа токена:');

        $tokenType = $tokenTypeRepository->create(apiServiceId: $apiServiceId, name: $name, type: Str::slug($name, '_'));

        $this->info('Тип токена добавлен: ID: ' . $tokenType->id . ' | Название: ' . $tokenType->name);

        return self::SUCCESS;
    }

    private function choiceApiServices(array $apiServices): int
    {
        return array_search($this->choice('Выберите API - сервис: ', $apiServices), $apiServices);
    }
}
