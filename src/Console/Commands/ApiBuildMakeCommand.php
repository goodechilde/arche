<?php

namespace Goodechilde\Arche\Console\Commands;

use Goodechilde\Arche\Console\Contracts\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Support\Str;

class ApiBuildMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arche:apibuild';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build openapi.yaml from staging.yaml file';

    /**
     * Build the class with the given name.
     *
     * @param string $name
     *
     * @return string
     */
    public function handle()
    {
        exec('swagger-cli bundle -t yaml staging.yaml > openapi.yaml');

        return 'openapi.yaml file combined.';
    }
}
