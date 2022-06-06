<?php

namespace Cyrtolat\Channels;

use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;

class ChannelServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Notification::resolved(static function (ChannelManager $service) {
            $service->extend('telegram', static function ($app) {
                return $app->make(Telegram\TelegramChannel::class);
            });
        });
    }
}
