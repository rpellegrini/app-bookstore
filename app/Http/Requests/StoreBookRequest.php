<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        if ($this->filled('price')) {
            $this->merge([
                'price' => str_replace(',', '.', str_replace('.', '', $this->price))
            ]);
        }
    }

    public function rules()
    {
        return [
            'title' => 'required|max:40',
            'publisher' => 'required|max:40',
            'edition' => 'required|integer|min:1',
            'publication_year' => 'required|digits:4',
           // 'price' => 'required|numeric|min:0',
            'authors' => 'required|array|min:1',
            'authors.*' => 'exists:authors,id',
            'subjects' => 'required|array|min:1',
            'subjects.*' => 'exists:subjects,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'O campo título é obrigatório.',
            'title.max' => 'O título deve ter no máximo 40 caracteres.',

            'publisher.required' => 'O campo editora é obrigatório.',
            'publisher.max' => 'A editora deve ter no máximo 40 caracteres.',

            'edition.required' => 'O campo edição é obrigatório.',
            'edition.integer' => 'A edição deve ser um número inteiro.',
            'edition.min' => 'A edição deve ser maior que zero.',

            'publication_year.required' => 'O campo ano de publicação é obrigatório.',
            'publication_year.digits' => 'O ano de publicação deve conter 4 dígitos.',

            'price.required' => 'O campo valor é obrigatório.',
            'price.numeric' => 'O valor deve ser numérico.',
            'price.min' => 'O valor não pode ser negativo.',

            'authors.required' => 'Selecione pelo menos um autor.',
            'authors.array' => 'O campo autores deve ser uma lista.',
            'authors.min' => 'Selecione pelo menos um autor.',
            'authors.*.exists' => 'Um dos autores selecionados é inválido.',

            'subjects.required' => 'Selecione pelo menos um assunto.',
            'subjects.array' => 'O campo assuntos deve ser uma lista.',
            'subjects.min' => 'Selecione pelo menos um assunto.',
            'subjects.*.exists' => 'Um dos assuntos selecionados é inválido.',
        ];
    }

}
