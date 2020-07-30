<?php

namespace Goodechilde\Arche\Console\Commands;

use Illuminate\Support\Str;
use Goodechilde\Arche\Console\Contracts\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class ServiceMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arche:service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new form service class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Service';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('type') == 'store') {
            return config('arche.stubs_dir') . '/service.store.stub';
        }
        if ($this->option('type') == 'update') {
            return config('arche.stubs_dir') . '/service.update.stub';
        }

        return config('arche.stubs_dir') . '/request.index.stub';
    }

    protected function buildClass($name)
    {
        $replace = [];
        if ($model = $this->option('model')) {
            $model = Str::studly(class_basename($this->option('model')));
            $slug = Str::slug(str_to_words($model), '_');
            $replace['$modelSlug$'] = $slug;
            $replace['$modelTable$'] = Str::plural($slug, 2);
        }

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\App\Services';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
//            ['model', 'm', InputOption::VALUE_REQUIRED, 'The given model.'],
//            ['type', 't', InputOption::VALUE_OPTIONAL, 'Type of request. Values can be store or update'],
        ];
    }
}
