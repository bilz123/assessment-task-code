<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('vendor.add');
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
            'email' => 'required|email|unique:users,email'
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'A vendor with this email has already been registered.',
        ];
    }
}
