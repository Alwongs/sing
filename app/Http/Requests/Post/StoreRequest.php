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
            'is_published' => ['nullable', 'boolean'],
            'image'        => ['image:jpeg,png,jpg,webp', 'max:10000']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title must be filled.',
            'title.max'      => 'Title is too long. Maximum 255 characters allowed.',
            'text.string'    => 'The content must be plain text or properly formatted HTML.',
            'image.max'      => 'Too large size of image. Maximum is 10MB',
            'image.image'    => 'Wrong type of file. Sould be image',
        ];
    }

    /**
     * Additonal valisdation after base one.
     * Block GIF, event if the file mimic as another type
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->hasFile('image')) {
                $image = $this->file('image');

                // Check real type (not trust extention!)
                if ($image->getMimeType() === 'image/gif') {
                    $validator->errors()->add('image', 'GIF files are not allowed. Please upload JPG, PNG, or WEBP images only.');
                }
            }
        });
    }    

}
