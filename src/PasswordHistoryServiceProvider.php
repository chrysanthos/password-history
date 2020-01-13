<?php

namespace Chrysanthos\PasswordHistory;

use Chrysanthos\PasswordHistory\Commands\ImportUserPasswordsCommand;
use Chrysanthos\PasswordHistory\Listeners\PasswordResetListener;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class PasswordHistoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if (config('password-history.enabled', true)) {
            Event::listen(
                PasswordReset::class,
                PasswordResetListener::class
            );
        }

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__.'/../config/password-history.php' => config_path('password-history.php'),
        ], 'config');

        if ($this->app->runningInConsole()) {
            $this->commands([ImportUserPasswordsCommand::class]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/password-history.php', 'password-history');
    }
}
