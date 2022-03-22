<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use App\Models\User;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {

/*        [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]*/

        $userValidationRulesArray = User::getUserValidationRulesArray(null, [
            'name', 'email', 'status', 'password', 'password_2', 'avatar'
        ]);

        \Log::info(  varDump($userValidationRulesArray, ' -1 UpdateUserProfileInformation::$userValidationRulesArray::') );
        \Log::info(  varDump($input, ' -12 $input::') );
        Validator::make($input, $userValidationRulesArray)->validateWithBag('updateProfileInformation');

        if (isset($input['avatar'])) {
            $user->updateProfilePhoto($input['avatar']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'account_type' => $input['account_type'],
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'phone' => $input['phone'],
                'website' => $input['website'],
                'notes' => $input['notes'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
