<?php

namespace Goodechilde\Arche\Console;

use Goodechilde\Arche\Console\Commands\SeederMakeCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Goodechilde\Arche\Console\Commands\ControllerMakeCommand;
use Goodechilde\Arche\Console\Commands\FactoryMakeCommand;
use Goodechilde\Arche\Console\Commands\Arche;
use Goodechilde\Arche\Console\Commands\MigrateMakeCommand;
use Goodechilde\Arche\Console\Commands\ModelMakeCommand;
use Goodechilde\Arche\Console\Commands\RequestMakeCommand;
use Goodechilde\Arche\Console\Commands\PolicyMakeCommand;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        ControllerMakeCommand::class,
        FactoryMakeCommand::class,
        Arche::class,
        MigrateMakeCommand::class,
        ModelMakeCommand::class,
        RequestMakeCommand::class,
        SeederMakeCommand::class,
        PolicyMakeCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
    }
}
