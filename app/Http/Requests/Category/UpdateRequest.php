<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $category = $this->route('category'); // Getting category object from route

        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'slug')->ignore($category->id), // Ignore current category when check if unique
            ]
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title must be filled.',
            'title.max' => 'Title should not be more then 255 symbols',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'title' => trim($this->title),
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
