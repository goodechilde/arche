<?php

namespace Goodechilde\Arche\Console\Commands;

use Symfony\Component\Console\Input\InputOption;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

class ApiBuildMakeCommand extends Command
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
     * @return string
     */
    public function handle()
    {
        exec('swagger-cli bundle -t yaml staging.yaml > openapi.yaml');
        
        exec('redoc-cli bundle -o public/docs/index.html openapi.yaml');

        return 'openapi.yaml file combined.';
    }
}
