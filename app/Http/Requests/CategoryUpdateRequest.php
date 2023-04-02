<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'description' => 'required',
        ];

    }
    public function messages(){
        return [
            'name.required' => 'Name field is required.',
            'name.string' => 'Name field must be a string.',
            'name.max' => 'Name cannot be more then 50 characters.',
            'description.required' => 'Description field is required.',
        ];
    }

    
}
