<?php

namespace Core\Users\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthenticateRequest extends FormRequest
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
            'register_number' => 'required|string',
            'password' => "required"
        ];
    }

    public function messages()
    {
        return [
            'register_number.required' => "Merci de renseigner votre numéro matricule pour vous connecter.",
            'password.required' => "Merci de renseigner votre mot de passe"

        ];
    }
}
