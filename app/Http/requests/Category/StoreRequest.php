<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
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
        if (Auth::check()) {
            $this->merge([
                'user_id' => Auth::id(),
            ]);
        }
    }    
}
