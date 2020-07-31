<?php

namespace Goodechilde\Arche\Console\Commands;

use Goodechilde\Arche\Console\Contracts\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Support\Str;

class SeederMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arche:seeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new database seeder';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Seeder';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return config('arche.stubs_dir').'/seeder.stub';
    }

    /**
     * Build the class with the given name.
     *
     * @param string $name
     *
     * @return string
     */
    protected function buildClass($name)
    {
        $model = $this->option('model')
            ? $this->qualifyClass($this->option('model'))
            : 'Model';
            $replace['DummyModel'] = $model;
            $replace['DummyPlural'] = Str::plural(Str::slug(studly_to_words($model), '_'));


        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );

    }

    /**
     * Get the destination class path.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getPath($name)
    {
        $name = str_replace(
            ['\\', '/'], '', $this->argument('name')
        );

        return $this->laravel->databasePath() . "/seeds/{$name}.php";
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['model', 'm', InputOption::VALUE_OPTIONAL, 'The name of the model'],
        ];
    }
}
