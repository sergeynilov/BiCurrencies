<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Validator;

class UserRegisterConfirmationCodeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $request = request();
        \Log::info('-1 UserRegisterConfirmationCodeRequest $request->all()::' . print_r($request->all(), true));

        /*[2022-04-02 03:57:45] local.INFO: -1 UserRegisterConfirmationCodeRequest $request->all()::Array
(
    [confirmation_code] => s1yLUNAM
    [user_email] => demo_user@site.com
    [user_id] => 25
)*/

        return [
            'confirmation_code' => 'required|min:8| ' . 'check_valid_confirmation_code:' . $request->confirmation_code . ','
                                   . $request->user_email . ',' . $request->user_id
        ];
    }

    public function messages()
    {
        return [
            'check_valid_confirmation_code' => 'Confirmation code is invalid or expired',
        ];
    }


}
