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
            'is_published' => ['nullable', 'boolean'],
            'image'        => ['image:jpeg,png,jpg,webp', 'max:10000']      
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title must be filled.',
            'title.max'      => 'Title should not be more then 255 symbols',
            'text.string'    => 'Text should be string',
            'image.max'      => 'Too large size of image. Maximum is 5MB',
            'image.image'    => 'Wrong type of file. Sould be image',            
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

        $validated = parent::validated();

        $user = auth()->user();
        if ($user && !$user->is_admin) {
            $validated['is_published'] = false;
        }

        // 3. Удаляем slug, если он присутствует
        if (isset($validated['slug'])) {
            unset($validated['slug']);
        }

        // 4. Если запрошен конкретный ключ, возвращаем значение по ключу
        if (!is_null($key)) {
            return data_get($validated, $key, $default);
        }

        // 5. Иначе возвращаем весь массив
        return $validated;













        // $data = parent::validated($key, $default);
        // if (is_array($data) && isset($data['slug'])) {
        //     unset($data['slug']);
        // }
        // return $data;
    }    
}
