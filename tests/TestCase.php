<?php


namespace Goodechilde\Arche\Tests;

use Illuminate\Support\Facades\Artisan;
use Goodechilde\Arche\ArcheServiceProvider;
use Orchestra\Testbench\TestCase as Testbench;

class TestCase extends Testbench
{
    public function removeGeneratedFiles()
    {
        if (file_exists(app_path('Http/Controllers/PostController.php'))) {
            unlink(app_path('Http/Controllers/PostController.php'));
        }

        if (file_exists(app_path('Http/Controllers/Dashboard/PostController.php'))) {
            unlink(app_path('Http/Controllers/Dashboard/PostController.php'));
        }

        if (file_exists(app_path('Http/Requests/PostUpdateRequest.php'))) {
            unlink(app_path('Http/Requests/PostUpdateRequest.php'));
        }

        if (file_exists(app_path('Http/Requests/PostStoreRequest.php'))) {
            unlink(app_path('Http/Requests/PostStoreRequest.php'));
        }

        if (file_exists(app_path('Post.php'))) {
            unlink(app_path('Post.php'));
        }

        if (file_exists(app_path('Models/Post.php'))) {
            unlink(app_path('Models/Post.php'));
        }

        if (file_exists(resource_path('views/posts'))) {
            unlink(resource_path('views/posts'));
        }

        if (file_exists(resource_path('views/dashboard/posts'))) {

            $this->rmdirRecursive(resource_path('views/dashboard/posts'));
        }

        if (file_exists(base_path('database/factories/PostFactory.php'))) {
            unlink(base_path('database/factories/PostFactory.php'));
        }

        $migrations = glob(base_path('database/migrations/*.php'));
        foreach ($migrations as $migration) {
            unlink($migration);
        }

        if (file_exists(base_path('database/factories/PostFactory.php'))) {
            unlink(base_path('database/factories/PostFactory.php'));
        }
    }

    public function deleteStubs()
    {
        if (file_exists(resource_path('stubs'))) {
            $stubs = glob(resource_path('stubs') . '/*.stub');
            foreach ($stubs as $stub) {
                if (!file_exists($stub)) {
                    continue;
                }
                unlink($stub);
            }
            $stubs = glob(resource_path('stubs') . '/view/*.stub');
            foreach ($stubs as $stub) {
                if (!file_exists($stub)) {
                    continue;
                }
                unlink($stub);
            }
            rmdir(resource_path('stubs/view'));
            rmdir(resource_path('stubs'));
        }
    }

    protected function getPackageProviders($app)
    {
        return [ArcheServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        Artisan::call("vendor:publish", ["--tag" => "arche"]);

    }

    protected function resolveApplicationConsoleKernel($app)
    {
        $app->singleton('Illuminate\Contracts\Console\Kernel', 'JunaidQadirB\Arche\Console\Kernel');
    }

    function rmdirRecursive($dir)
    {
        $files = scandir($dir);
        foreach ($files as $file) {
            if ($file == '.' OR $file == '..') continue;

            $file = "$dir/$file";
            if (!file_exists($file)) {
                continue;
            }
            if (is_dir($file) && file_exists($file)) {
                $this->rmdirRecursive($file);
                if (file_exists($file)) {
                    rmdir($file);
                }

            } elseif (file_exists($file)) {
                unlink($file);
            }
        }
        if (!file_exists($dir)) {
            return;
        }
        rmdir($dir);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMockingConsoleOutput();
        if (file_exists(resource_path('views/posts'))) {
            $this->rmdirRecursive(resource_path('views/posts'));
        }
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        if (file_exists(resource_path('views/posts'))) {
//            $this->rmdirRecursive(resource_path('views/posts'));
        }
    }
}
