<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'title'        => ['required', 'string', 'max:255'],
            'text'         => ['nullable',  'string' ],
            'is_published' => ['required', 'boolean'],            
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title must be filled.',
            'title.max'      => 'Title should not be more then 255 symbols',
            'text.string'    => 'Text should be string',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'title' => trim($this->title),
            'text' => $this->text ? trim($this->text) : null,
        ]);

        $this->request->remove('slug');
    } 
    
    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);

        if (is_array($data) && isset($data['slug'])) {
            unset($data['slug']);
        }

        return $data;
    }    
}
