<?php

namespace Chrysanthos\PasswordHistory\Tests;

use Chrysanthos\PasswordHistory\PasswordHistoryServiceProvider;
use Chrysanthos\PasswordHistory\Tests\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Orchestra\Testbench\TestCase;
use Illuminate\Database\Eloquent\Model;

class TestDisabledPasswordHistoryJob extends TestCase
{
    protected function getEnvironmentSetUp($app): void
    {
        parent::getEnvironmentSetUp($app);

        $app['config']->set('password-history.enabled', false);
    }

    public function test_that_it_does_not_store_password_resets_when_disabled()
    {
        $this->migrate();

        event(new PasswordReset($user = $this->getUser()));

        $this->assertDatabaseMissing('password_history', [
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

class User extends Model
{
    protected $guarded = [];
}
