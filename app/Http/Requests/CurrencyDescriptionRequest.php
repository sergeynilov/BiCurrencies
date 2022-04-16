<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Currency;
class CurrencyDescriptionRequest extends FormRequest
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
        $request= Request();
        return Currency::getCurrencyValidationRulesArray( $request->get('id'), ['name', 'num_code', 'char_code', 'color', 'bgcolor', 'ordering'] );
    }
}
