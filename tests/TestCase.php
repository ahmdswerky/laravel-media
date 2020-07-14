<?php

namespace AhmdSwerky\Media\Tests;

use AhmdSwerky\Media\MediaBaseServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate', ['--database' => 'testbench'])->run();
    }
    
    public function getPackageProviders($app)
    {
        return [
            MediaBaseServiceProvider::class,
        ];
    }
    
    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
        ]);
    }
}