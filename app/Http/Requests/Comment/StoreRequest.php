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
        return [
            'guest_name'  => ['sometimes', 'required_if:auth,false', 'max:50'],            
            'body'        => ['required', 'string', 'max:2000'],
        ];
    }

    protected function prepareForValidation()
    {
        if (auth()->check()) {
            return;
        }

        $this->merge([
            'guest_name' => trim($this->guest_name) ?: 'Guest',
        ]);
    }    
}
