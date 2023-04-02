<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddonStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('addon.add');
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
            'price' => 'required|min:1',
            'description' => 'required|max:50'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name field is required.',
            'name.string' => 'Name field must be a string.',
            'name.max' => 'Name cannot be more then 50 characters.',
            'description.required' => 'Description field is required.',
            'description.max' => 'Description cannot be more then 50 characters.',
        ];
    }
}
