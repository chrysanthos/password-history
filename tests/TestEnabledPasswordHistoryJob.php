<?php

namespace Chrysanthos\PasswordHistory\Tests;

use Chrysanthos\PasswordHistory\PasswordHistoryServiceProvider;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Orchestra\Testbench\TestCase;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $guarded = [];
}

class TestEnabledPasswordHistoryJob extends TestCase
{
    protected function getEnvironmentSetUp($app): void
    {
        parent::getEnvironmentSetUp($app);

        $app['config']->set('password-history.enabled', true);
    }

    public function test_that_it_stores_password_resets_when_enabled()
    {
        $this->app['config']->set('password-history.enabled', true);
        $this->migrate();

        event(new PasswordReset($user = $this->getUser()));

        $this->assertDatabaseHas('password_history', [
            'user_id'  => $user->id,
            'password' => $user->password,
        ]);
    }

    protected function getUser()
    {
        return User::create([
            'name'     => 'Chrysanthos',
            'email'    => 'first@chrysanthos.dev',
            'password' => Hash::make('password'),
        ]);
    }

    protected function migrate(): void
    {
        $this->loadLaravelMigrations();
        $this->artisan('migrate')->run();
    }

    protected function getPackageProviders($app)
    {
        return [PasswordHistoryServiceProvider::class];
    }
}
