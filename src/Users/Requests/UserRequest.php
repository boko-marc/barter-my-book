<?php

namespace Core\Users\Requests;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {

        if ($this->isMethod("post")) {
            return [
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8|confirmed',
                'register_number' => 'required|unique:users|string',
                'last_name' => 'required|string',
                'first_name' => 'required|string',
                'class' => 'required|integer|in:6,5,4,3,2,1,0',
                'school_id' => 'required|exists:schools,id',
            ];
        } elseif ($this->isMethod("patch")) {
            return [
                'email' => ['required', 'email', Rule::unique('users')->ignore($this->user()->id)],
                'register_number' => 'required|unique:users|string',
                'last_name' => 'required|string',
                'first_name' => 'required|string',
                'class' => 'required|integer|in:6,5,4,3,2,1,0',
                'school_id' => ['required', 'exists:schools,id'],

            ];
        }
    }

    public function messages()
    {
        return [
            'class.required' => 'Veuillez préciser la classe que vous faites pour vous inscrire',
            "class.in" => "Votre classe doit être comprise entre la 6ème et la Tle",
            "school_id.required" => "Veuillez préciser votre établissement pour vous inscrire",
            "school_id.exists" => "L'établissement que vous avez sélectionné n'existe pas",
            'last_name.required' => 'Le nom est obligatoire',
            'first_name.required' => 'Le prénom est obligatoire',
            'email.required' => 'L\'email est obligatoire',
            'register_number.required' => 'Le numéro matricule est obligatoire',
            'email.email' => 'L\'email ne respecte pas le bon format',
            'email.unique' => 'L\'email est déja utilisé par un utilisateur',
            'register_number.unique' => 'Le numéro matricule est déja utilisé par un utilisateur',
            'password.required' => 'Le mot de passe est obligatoire',
            'password.confirmed' => 'Mauvaise confirmation du mot de passe',
            'password.min' => 'Le mot de passe doit être au minimum 8 caractères',
        ];
    }
}
