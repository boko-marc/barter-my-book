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
        if ($this->isMethod('post')) {
            return [
                "title" => "required|string",
                'author' => "nullable|string",
                'edition' => "nullable",
                'subject' => "required|in:mathematiques,pct,francais,anglais,allemand,svt,philosophie,economie,autre,eps,espagnol,hg",
                'condition' => "required|integer|in:1,2,3", // 1 Moyen 2 Bon état 3 Neuf
                'description' => "nullable|string",
                'class' => "nullable|in:6,5,4,3,2,1,0",
                "book_pictures" => 'present|array',
                "book_pictures.*" => "image"

            ];
        } elseif ($this->isMethod('patch')) {
            return [
                "title" => "string",
                'author' => "nullable|string",
                'edition' => "nullable",
                'subject' => "in:mathematiques,pct,francais,anglais,allemand,svt,philosophie,economie,autre,eps,espagnol,hg",
                'condition' => "integer|in:1,2,3", // 1 Moyen 2 Bon état 3 Neuf
                'description' => "nullable|string",
                'class' => "nullable|in:6,5,4,3,2,1,0",


            ];
        }
    }

    public function attributes()
    {
        return [
            'title' => 'titre',
            'author' => 'auteur',
            'subject' => 'matière',
            'condition' => 'condition',
            'description' => 'description',
            'class' => 'classe',
            'books_pictures' => 'images du livre',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Le champ :attribute est obligatoire et doit être une chaîne de caractères.',
            'author.string' => 'Le champ :attribute doit être une chaîne de caractères.',
            'subject.required' => 'Le champ :attribute est obligatoire et doit être l\'une des suivantes : mathematiques, pct, francais, anglais, allemand, svt, philosophie, economie, autre, eps, espagnol, hg.',
            'subject.in' => 'Le champ :attribute doit être l\'une des suivantes : mathematiques, pct, francais, anglais, allemand, svt, philosophie, economie, autre, eps, espagnol, hg.',
            'condition.required' => 'Le champ :attribute est obligatoire et doit être l\'une des suivantes : 1 (Moyen), 2 (Bon état), 3 (Neuf).',
            'condition.integer' => 'Le champ :attribute doit être un nombre entier.',
            'condition.in' => 'Le champ :attribute doit être l\'une des suivantes : 1 (Moyen), 2 (Bon état), 3 (Neuf).',
            'description.string' => 'Le champ :attribute doit être une chaîne de caractères.',
            'class.in' => 'Le champ :attribute doit être l\'une des suivantes : 6, 5, 4, 3, 2, 1, 0.',
            'books_pictures.present' => 'Le champ :attribute doit être présent.',
            'books_pictures.array' => 'Le champ :attribute doit être un tableau (array).',
            'books_pictures.*.image' => 'Chaque élément de :attribute doit être une image.',
        ];
    }
}
