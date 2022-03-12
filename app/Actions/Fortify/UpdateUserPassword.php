<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and update the user's password.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        \Log::info(  varDump($input, ' -1 UpdateUserPassword $input::') );
        Validator::make($input, [
            'current_password' => ['required', 'string'],
            'password' => $this->passwordRules(),
        ])->after(function ($validator) use ($user, $input) {
            \Log::info(  varDump(-2, ' -2 UpdateUserPassword::') );
            if (! isset($input['current_password']) || ! Hash::check($input['current_password'], $user->password)) {
                \Log::info(  varDump(-3, ' -3 UpdateUserPassword::') );
                $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
            }
        })->validateWithBag('updatePassword');
        \Log::info(  varDump(-4, ' -4 UpdateUserPassword::') );

        $ret= $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
        \Log::info(  varDump($ret, ' -1 UpdateUserPassword $ret::') );
        return $ret;
    }
}
