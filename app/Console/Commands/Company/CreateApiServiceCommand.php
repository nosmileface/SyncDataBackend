<?php

namespace App\Console\Commands\Company;

use App\Repositories\Company\ApiService\ApiServiceRepository;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

#[Signature('app:create-api-service')]
#[Description('Создать сервис.')]
class CreateApiServiceCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(ApiServiceRepository $apiServiceRepository): int
    {
        $name = $this->ask('Введите название сервиса:');

        $apiService = $apiServiceRepository->create(name: $name, type: Str::slug($name, '_'));

        $this->info('Сервис добавлен: ' . 'ID: ' . $apiService->id . ' | Название: ' . $apiService->name);

        return self::SUCCESS;
    }
}
