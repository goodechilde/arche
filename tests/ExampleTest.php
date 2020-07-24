<?php

namespace Goodechilde\Arche\Tests;

use Goodechilde\Arche\ArcheServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [ArcheServiceProvider::class];
    }

    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
