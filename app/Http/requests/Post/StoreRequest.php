<?php

namespace App\Http\Requests\Post;

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
            'title'        => ['required', 'string', 'max:255'],
            'text'         => ['nullable', 'string', 'max:10000'],
            'category_id'  => ['nullable', 'exists:categories,id'],
            'is_published' => ['required', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title must be filled.',
            'title.max'      => 'Title is too long. Maximum 255 characters allowed.',
            'text.string' => 'The content must be plain text or properly formatted HTML.',
        ];
    }

}
