<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'body' => 'required|string|max:5000',
        ];

        // если не залогинен – требуем name + email
        if (!auth()->check()) {
            $rules['guest_name']  = 'required|string|max:60';
            $rules['guest_email'] = 'nullable|email|max:255';
        }

        return $rules;
    }
}
