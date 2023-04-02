<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorUpdateRequest extends FormRequest
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
            'is_active' => 'nullable',
            'comments' => 'required_without:is_active'
        ];
    }

    public function messages()
    {
        return [
            'comments.required_without' => 'Comments are required if the status is inactive/suspended.',
        ];
    }
}
