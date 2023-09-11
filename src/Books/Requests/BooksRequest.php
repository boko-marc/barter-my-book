<?php

namespace Core\Books\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BooksRequest extends FormRequest
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
            "title" => "required|string",
            'author' => "nullable|string",
            'edition' => "nullable",
            'subject' => "required|in:mathematiques,pct,francais,anglais,allemand,svt,philosophie,economie,autre,eps,espagnol,hg",
            'condition' => "required|integer|in:1,2,3", // 1 Moyen 2 Bon état 3 Neuf
            'description' => "nullable|string",
            'class' => "nullable|in:6,5,4,3,2,1,0",
            "books_pictures" => 'present|array',
            "books_pictures.*" => "image"

        ];
    }

    public function messages()
    {
        return [
            'verification_code.required' => "Le code d'activation est obligatoire",
        ];
    }

}