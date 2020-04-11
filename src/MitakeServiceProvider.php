<?php

namespace NotificationChannels\Mitake;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class MitakeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->when(MitakeChannel::class)
            ->needs(Mitake::class)
            ->give(function () {
                return new Mitake(
                    config('services.mitake.username'),
                    config('services.mitake.password'),
                    new Client(),
                    config('services.mitake.url')
                );
            });
    }
}
