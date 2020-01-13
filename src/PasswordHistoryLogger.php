<?php

namespace Chrysanthos\PasswordHistory;

use Illuminate\Support\Facades\DB;

class PasswordHistoryLogger
{
    public static function insert(int $user_id, string $password)
    {
        return DB::table(config('password-history.tables.password-history.name', 'password_history'))
                 ->insertOrIgnore([
                     'user_id'  => $user_id,
                     'password' => $password,
                 ]);
    }

    public static function insertMany($values)
    {
        return DB::table(config('password-history.tables.password-history.name', 'password_history'))
                 ->insertOrIgnore($values);
    }
}
