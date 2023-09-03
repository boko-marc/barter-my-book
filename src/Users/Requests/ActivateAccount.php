<?php

namespace Core\Users\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivateAccount extends FormRequest
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
        return [
            'verification_code' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'verification_code.required' => "Le code d'activation est obligatoire",
        ];
    }

}