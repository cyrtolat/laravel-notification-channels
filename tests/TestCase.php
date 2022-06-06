<?php

namespace Cyrtolat\Channels\Tests;

use Cyrtolat\Channels\ChannelServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            ChannelServiceProvider::class,
        ];
    }
}