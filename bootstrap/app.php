<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;

const FIRST_SCHEDULE_RUN = 6;
const SECOND_SCHEDULE_RUN = 18;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withSchedule(function (Schedule $schedule): void {
        $schedule->command('app:sync-incomes')
            ->twiceDaily(FIRST_SCHEDULE_RUN, SECOND_SCHEDULE_RUN)
            ->withoutOverlapping();

        $schedule->command('app:sync-orders')
            ->twiceDaily(FIRST_SCHEDULE_RUN, SECOND_SCHEDULE_RUN)
            ->withoutOverlapping();

        $schedule->command('app:sync-sales')
            ->twiceDaily(FIRST_SCHEDULE_RUN, SECOND_SCHEDULE_RUN)
            ->withoutOverlapping();

        $schedule->command('app:sync-stocks')
            ->twiceDaily(FIRST_SCHEDULE_RUN, SECOND_SCHEDULE_RUN)
            ->withoutOverlapping();
    })
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
