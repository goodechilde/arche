<?php

namespace Goodechilde\Arche\Console;

use Goodechilde\Arche\Console\Commands\OpenapiComponentMakeCommand;
use Goodechilde\Arche\Console\Commands\OpenapiMakeCommand;
use Goodechilde\Arche\Console\Commands\OpenapiParameterMakeCommand;
use Goodechilde\Arche\Console\Commands\OpenapiSchemaMakeCommand;
use Goodechilde\Arche\Console\Commands\ResourceMakeCommand;
use Goodechilde\Arche\Console\Commands\ApiBuildMakeCommand;
use Goodechilde\Arche\Console\Commands\SeederMakeCommand;
use Goodechilde\Arche\Console\Commands\ServiceMakeCommand;
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
        ApiBuildMakeCommand::class,
        PolicyMakeCommand::class,
        ResourceMakeCommand::class,
        ServiceMakeCommand::class,
        SeederMakeCommand::class,
        OpenapiMakeCommand::class,
        OpenapiComponentMakeCommand::class,
        OpenapiParameterMakeCommand::class,
        OpenapiSchemaMakeCommand::class,
        ApiBuildMakeCommand::class,
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
