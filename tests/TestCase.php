<?php

namespace Cyrtolat\NotificationChannels\Tests;

use Cyrtolat\NotificationChannels\ChannelServiceProvider;

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