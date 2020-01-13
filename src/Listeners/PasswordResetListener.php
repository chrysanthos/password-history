<?php

namespace Chrysanthos\PasswordHistory\Listeners;

use Chrysanthos\PasswordHistory\Jobs\LogPasswordForUserAction;

class PasswordResetListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     *
     * @return void
     */
    public function handle($event)
    {
        $job = new LogPasswordForUserAction($event->user->id, $event->user->getOriginal('password'));

        if (config('password-history.sync', true)) {
            dispatch($job);
        } else {
            dispatch_now($job);
        }
    }
}
