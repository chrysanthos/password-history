<?php

namespace Chrysanthos\PasswordHistory\Rules;

use Chrysanthos\PasswordHistory\Models\PasswordHistoryEntry;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class NoOldPasswords implements Rule
{
    /**
     * @var int
     */
    protected $user_id;

    /**
     * @var string
     */
    protected $attemptedPassword;

    /**
     * Create a new rule instance.
     *
     * @param  int  $user_id
     * @param  string  $attemptedPassword
     */
    public function __construct(int $user_id, string $attemptedPassword)
    {
        $this->user_id = $user_id;
        $this->attemptedPassword = $attemptedPassword;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return PasswordHistoryEntry::select('password')
                                   ->where('user_id', $this->user_id)
                                   ->get()
                                   ->pluck('password')
                                   ->filter(function ($value) {
                                       return Hash::check($this->attemptedPassword, $value);
                                   })
                                   ->isEmpty();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You cannot use a password you had before.';
    }
}
