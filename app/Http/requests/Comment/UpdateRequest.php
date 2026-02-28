<?php

namespace App\Http\Requests\Comment;

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
        return [
            'guest_name'  => ['sometimes', 'required_if:auth,false', 'max:50'],            
            'body'        => ['required', 'string', 'max:2000'],
            'is_approved'  => ['required', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            'guest_name.max' => 'Title should not be more then 50 symbols',
            'body.max' => 'Body should not be more then 2000 symbols',
        ];
    }
     
}
