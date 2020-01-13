<?php

namespace Chrysanthos\PasswordHistory\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class PasswordHistoryEntry extends Eloquent
{
    protected $fillable = ['user_id', 'password'];

    public function __construct(array $attributes = [])
    {
        if (! isset($this->connection)) {
            $this->setConnection(config('password-history.tables.password-history.connection'));
        }
        if (! isset($this->table)) {
            $this->setTable(config('password-history.tables.password-history.name', 'password_history'));
        }

        parent::__construct($attributes);
    }

}
