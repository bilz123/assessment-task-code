<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'icon' => 'required|file|mimes:jpg,png,gif,svg|max:2560', // 1024 KB = 1 MB
            'name' => 'required|string|max:50',
            'description' => 'required'
        ];
    }

    public function messages(){
        return [
            'icon.size' => 'Poster must be less then 2.5MB.',
            'icon.size' => 'Poster field is required.',
            'name.required' => 'Name field is required.',
            'name.string' => 'Name field must be a string.',
            'name.max' => 'Name cannot be more then 50 characters.',
            'description.required' => 'Description field is required.',
        ];
    }
}
