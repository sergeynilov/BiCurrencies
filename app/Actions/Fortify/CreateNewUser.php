<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;

//use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Actions\Fortify\CreatesNewUsers;

// /_wwwroot/lar/hostels4j/resources/fortify/CreatesNewUsers.php
use Laravel\Jetstream\Jetstream;
use Spatie\Permission\Models\Permission;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param array $input
     *
     * @return \App\Models\User
     */
    public function create(array $input, bool $make_validation, array $hasPermissions)
    {
//        \Log::info(varDump($make_validation, ' -1 $make_validation::'));

//        \Log::info(varDump(\App::runningInConsole(), ' -1 App::runningInConsole()::'));
//        \Log::info(varDump(\App::runningInConsole(), ' -1 $hasPermissions'));

        if ($make_validation) {
            $userValidationRulesArray = User::getUserValidationRulesArray(null,  []);
//            \Log::info(varDump($userValidationRulesArray, ' -1 CreateNewUser $userValidationRulesArray::'));
//            $userValidationRulesArray['password'] = $this->passwordRules();
            if (\App::runningInConsole()) {
                unset($userValidationRulesArray['password_2']);
            }


//            \Log::info(varDump($userValidationRulesArray, ' -12 CreateNewUser $userValidationRulesArray::'));
            $validator = Validator::make($input, $userValidationRulesArray);//->validate();
            if ($validator->fails()) {
//                \Log::info(varDump(-1, ' -1 FAILS::'));
                $errorMsg = $validator->getMessageBag();
//                \Log::info(varDump($errorMsg, ' -1 $errorMsg::'));
                if (\App::runningInConsole()) {
                    echo '::$errorMsg::' . print_r($errorMsg, true) . '</pre>';
                }

                return $errorMsg;
            }
        } // if($make_validation) {

        $newUserData = [
            'name'         => $input['name'],
            'email'        => $input['email'],
        ];

        if (isset($input['id'])) {
            $newUserData['id'] = $input['id'];
        }
        if (isset($input['account_type'])) {
            $newUserData['account_type'] = $input['account_type'];
        }
        if (isset($input['phone'])) {
            $newUserData['phone'] = $input['phone'];
        }
        if (isset($input['website'])) {
            $newUserData['website'] = $input['website'];
        }
        if (isset($input['notes'])) {
            $newUserData['notes'] = $input['notes'];
        }

        if (isset($input['first_name'])) {
            $newUserData['first_name'] = $input['first_name'];
        }
        if (isset($input['last_name'])) {
            $newUserData['last_name'] = $input['last_name'];
        }

        if (isset($input['password'])) {
            $newUserData['password'] = Hash::make($input['password']);
        }
        if (isset($input['status'])) {
            $newUserData['status'] = $input['status'];
        }
        if (isset($input['activated_at'])) {
            $newUserData['activated_at'] = $input['activated_at'];
        }
        \Log::info(varDump($newUserData, ' -1 CreateNewUser $newUserData::'));


        try {
            DB::beginTransaction();

            $newUser = User::create($newUserData);
//            \Log::info(varDump($newUser, ' -1 $newUser::'));
            foreach ($hasPermissions as $nextHasPermission) {
//                \Log::info(varDump($nextHasPermission, ' -12 $nextHasPermission::'));
                $appAdminPermission = Permission::findByName($nextHasPermission, 'web');
//                \Log::info(varDump($appAdminPermission, ' -1 $appAdminPermission::'));
                if ($appAdminPermission) {
                    $newUser->givePermissionTo($appAdminPermission);
                }

            }
            DB::commit();
            return $newUser;

        } catch (QueryException $e) {
            DB::rollBack();
//            \Log::info(varDump($e->getMessage(), ' -19 $e->getMessage()::'));
            $errorMessages = new \Illuminate\Support\MessageBag;
            $errorMessages->add('name', $e->getMessage());
            \Log::info(varDump($errorMessages, ' -20 $errorMessages::'));
            if (\App::runningInConsole()) {
                echo '::$e->getMessage()::' . print_r($e->getMessage(), true) . '</pre>';
            }
            return $errorMessages;
        }
        return false;
    }
}
