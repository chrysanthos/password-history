<?php

namespace Chrysanthos\PasswordHistory;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Chrysanthos\PasswordHistory\PasswordHistoryLogger
 */
class PasswordHistoryFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'password-history';
    }
}
