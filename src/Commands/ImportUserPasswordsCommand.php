<?php

namespace Chrysanthos\PasswordHistory\Commands;

use App\User;
use Chrysanthos\PasswordHistory\PasswordHistoryLogger;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class ImportUserPasswordsCommand extends Command
{

    protected $signature = 'password-history:import';

    protected $description = 'Imports the current user passwords into history';

    public function handle()
    {
        $count = 0;
        \DB::connection(config('password-history.tables.users.connection'))
           ->table(config('password-history.tables.users.name'))
           ->cursor()
           ->chunk(500)
           ->each(function ($userChunk) use (&$count) {
               $passwords = $this->getImportablePasswords($userChunk);

               $count += PasswordHistoryLogger::insertMany(
                   array_map(static function ($user_id, $password) {
                       return [
                           'user_id'    => $user_id,
                           'password'   => $password,
                           'created_at' => now()
                       ];
                   }, array_keys($passwords), $passwords)
               );
           });

        $message = $count > 0 ? "{$count} new passwords have been imported!" : 'No new passwords have been imported..';

        $this->info($message);

    }

    public function getImportablePasswords($userChunk) : array
    {
        $passwords = Arr::pluck($userChunk, 'password', 'id');

        return Arr::where($passwords, static function ($password) {
            return $password && strlen($password) > 0;
        });
    }
}
