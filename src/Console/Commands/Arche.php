<?php

namespace Goodechilde\Arche\Console\Commands;

use Illuminate\Support\Str;
use Goodechilde\Arche\Console\Contracts\GeneratorCommand;

class Arche extends GeneratorCommand
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arche';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'arche
    {name : Model name. Controller, factory, migration, views will be based on this name.}
    {--views-dir= : Place views in a sub-directory under the views directory. It can be any nested directory structure}
    {--controller-dir= : Place controller in a sub-directory under the Http/Controllers directory. It can be any nested directory structure}
    {--stubs-dir= : Specify a custom stubs directory}
    {--no-views : Do not create view files for the model}
    {--no-migration : Do not create a migration for the model}
    {--no-factory : Do not create a factory for the model}
    {--no-policy : Do not create a policy for the model}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold a nearly complete boilerplate CRUD pages for the specified Model';

    /**
     * Create a new command instance.
     *
     */
    /*    public function __construct()
        {
            parent::__construct();
        }*/

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /**
         * Steps
         * - Generate Model
         * - Generate Factory
         * - Generate Migration
         * - Generate Controller
         * - Generate Requests
         * - Generate Seeder
         *
         */
        $this->type = 'Model';

        if (!$this->option('no-factory')) {
            $this->createFactory();
            $this->createSeeder();
        }

        if (!$this->option('no-migration')) {
            $this->createMigration();
        }
        $this->createController();
        $this->createResource();
        $this->createService('Index');
        $this->createService('Store');
        $this->createService('Update');

        $this->type = 'Request';

        $this->createRequest('Store');

        $this->createRequest('Update');
        $this->createOpenapi('Openapi');
        if (!$this->option('no-policy')) {
            $this->createPolicy();
        }


    }

    /**
     * Create a model factory for the model.
     *
     * @return void
     */
    protected function createFactory()
    {
        $factory = Str::studly(class_basename($this->argument('name')));

        $this->call('arche:factory', [
            'name' => "{$factory}Factory",
            '--model' => $this->argument('name'),
        ]);
    }

    /**
     * Create a database seeder for the model.
     *
     * @return void
     */
    protected function createSeeder()
    {
        $seeder = Str::studly(class_basename($this->argument('name')));

        $this->call('arche:seeder', [
            'name' => "{$seeder}Seeder",
            '--model' => $this->argument('name'),
        ]);
    }


    /**
     * Create a migration file for the model.
     *
     * @return void
     */
    protected function createMigration()
    {
        $table = Str::plural(Str::snake(class_basename($this->argument('name'))));

        $this->call('arche:migration', [
            'name' => "create_{$table}_table",
            '--create' => $table,
        ]);
    }

    /**
     * Create a controller for the model.
     *
     * @return void
     */
    protected function createController()
    {

        $controller = Str::studly(class_basename($this->argument('name')));

        $modelName = $this->qualifyClass($this->getNameInput());

        $args = [
            'name' => "{$controller}Controller",
            '--model' => $modelName,
        ];

        $viewsDir = $this->option('views-dir');
        if ($viewsDir) {
            $args['--views-dir'] = $viewsDir;
        }

        $controllerDir = $this->option('controller-dir');
        if ($controllerDir) {
            $args['--controller-dir'] = $controllerDir;
        }

        $this->call('arche:controller', $args);
    }


    /**
     * Create a resource for the model.
     *
     * @return void
     */
    protected function createResource()
    {
        $model = Str::studly(class_basename($this->argument('name')));
        $name = "{$model}Resource";
        $this->call('arche:resource', [
            'name' => $name,
        ]);
    }

    /**
     * Create a set of services for the model.
     *
     * @return void
     */
    protected function createService($serviceType = 'Index')
    {
        $model = Str::studly(class_basename($this->argument('name')));
        $name = "{$model}{$serviceType}Service";
        $this->call('arche:service', [
            'name' => $name,
            '--model' => $model,
            '--type' => Str::slug($serviceType),
        ]);
    }

    /**
     * Create a controller for the model.
     *
     * @param string $requestType
     *
     * @return void
     */
    protected function createRequest($requestType = 'Store')
    {
        $model = Str::studly(class_basename($this->argument('name')));
        $name = "{$model}{$requestType}Request";
        $this->call('arche:request', [
            'name' => $name,
            '--model' => $model,
            '--type' => Str::slug($requestType),
        ]);
    }
    /**
     * Create a controller for the model.
     *
     * @param string $requestType
     *
     * @return void
     */
    protected function createOpenapi()
    {
        $model = Str::studly(class_basename($this->argument('name')));
        $name = "{$model}";
        $this->call('arche:openapi', [
            'name' => $name,
            '--model' => $model,
        ]);
    }


    /**
     * Create a policy for the model.
     *
     * @return void
     */
    protected function createPolicy()
    {
        $model = Str::studly(class_basename($this->argument('name')));
        $name = "{$model}Policy";
        $this->call('arche:policy', [
            'name' => $name,
            '--model' => $model,
        ]);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return config('arche.stubs_dir') . '/' . Str::slug($this->type) . '.stub';
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
        switch ($this->type) {
            case 'Request':
                return $rootNamespace . '\Http\Requests';
        }

        return $rootNamespace;
    }
}
