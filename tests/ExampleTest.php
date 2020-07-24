<?php

namespace Goodechilde\Arche\Tests;

use Goodechilde\Arche\CrayServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [CrayServiceProvider::class];
    }

    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
