<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AllergenStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('allergen.add');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'icon' => 'required|file|mimes:jpg,png,gif,svg|max:1024', // 1024 KB = 1 MB
            'name' => 'required|string|max:50',
            'description' => 'required'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'icon.size' => 'Icon must be less then 1 MB.',
            'name.required' => 'Name field is required.',
            'name.string' => 'Name field must be a string.',
            'name.max' => 'Name cannot be more then 50 characters.',
            'description.required' => 'Description field is required.',
        ];
    }
}
