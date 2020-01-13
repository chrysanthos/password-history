<?php

namespace Chrysanthos\PasswordHistory\Jobs;

use Chrysanthos\PasswordHistory\PasswordHistoryLogger;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LogPasswordForUserAction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $password;

    /**
     * @var int
     */
    protected $user_id;

    /**
     * Create a new job instance.
     *
     * @param  int  $user_id
     * @param  string  $password
     */
    public function __construct(int $user_id, string $password)
    {
        $this->user_id = $user_id;
        $this->password = $password;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        PasswordHistoryLogger::insert($this->user_id, $this->password);
    }
}
