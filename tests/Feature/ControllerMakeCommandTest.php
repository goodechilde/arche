<?php


namespace Goodechilde\Arche\Tests\Feature;


use Illuminate\Support\Facades\Artisan;
use Goodechilde\Arche\Tests\TestCase;

class ControllerMakeCommandTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->removeGeneratedFiles();
    }

    public function test_it_throws_exception_when_a_name_is_not_passed()
    {
        $this->expectException(\Symfony\Component\Console\Exception\RuntimeException::class);
        $this->artisan('arche:controller');
    }

    public function test_it_creates_a_controller_with_the_given_name()
    {
        $this->artisan('arche:controller PostController');
        $output = Artisan::output();
        $expectedOutput = 'Controller created successfully in /app/Http/Controllers/PostController.php' . PHP_EOL;
        $this->assertSame($expectedOutput, $output);
    }

    public function test_it_gives_an_error_if_controller_exists()
    {
        $this->artisan('arche:controller PostController');
        $this->artisan('arche:controller PostController');
        $output = Artisan::output();
        $this->assertSame('Controller already exists!' . PHP_EOL, $output);
    }

    public function test_generates_a_resource_controller_for_the_given_model()
    {
        $this->artisan('arche:controller PostController --model=Post');
        $output = Artisan::output();
        $expected = 'Model created successfully in /app/Post.php' . PHP_EOL
            . 'Controller created successfully in /app/Http/Controllers/PostController.php' . PHP_EOL;
        $this->assertSame($expected, $output);
        $this->assertFileExists(app_path('/Http/Controllers/PostController.php'));
    }

    public function test_it_uses_the_specified_route_or_falls_back_to_model_slug()
    {
        //Scenario 1
        $this->artisan('arche:controller PostController --model=Post --views-dir=posts --route-base=my-posts');
        $controllerContents = file_get_contents(app_path('/Http/Controllers/PostController.php'));
        $this->assertStringContainsStringIgnoringCase("return \$this->success('Post added successfully!', 'my-posts.index');", $controllerContents);

        unlink(app_path('Http/Controllers/PostController.php'));

        //Scenario 1
        $this->artisan('arche:controller PostController --model=Post --views-dir=posts');
        $controllerContents = file_get_contents(app_path('/Http/Controllers/PostController.php'));
        $this->assertStringContainsStringIgnoringCase("return \$this->success('Post added successfully!', 'posts.index');", $controllerContents);
    }

    public function test_it_creates_the_controller_in_the_specified_directory_namespace()
    {
        $this->removeGeneratedFiles();
        $this->artisan('arche:controller PostController --model=Post --controller-dir=Dashboard');
        $output = Artisan::output();
        $expected = "Model created successfully in /app/Post.php" . PHP_EOL
            . "Controller created successfully in /app/Http/Controllers/Dashboard/PostController.php" . PHP_EOL;
        $this->assertSame($expected, $output);
    }

    public function test_it_creates_the_controller_with_the_specified_route_base()
    {
        $this->removeGeneratedFiles();
        $this->artisan('arche:controller PostController --model=Post --controller-dir=Dashboard --route-base=dashboard.posts');
        $controllerContents = file_get_contents(app_path('/Http/Controllers/Dashboard/PostController.php'));
        $this->assertStringContainsStringIgnoringCase("return \$this->success('Post added successfully!', 'dashboard.posts.index');", $controllerContents);
    }

}
