<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SafePassUpdate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->email = request('verify');
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // dd($this->email);
        return $this->email && $value == $this->email;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Você não pode mudar a senha de outro usuário.';
    }
}
