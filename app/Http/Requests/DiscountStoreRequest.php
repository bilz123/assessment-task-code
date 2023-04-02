<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DiscountStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('discount.add');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        
        return [
            'code' => 'required|max:10|unique:discount_coupons,code,'.$request->route('discount').',uuid',
            'type' => 'required',
            'value' => 'integer|required|min:1',
            'start_date' => 'required',
            'number_of' => 'required|gte:-1',
        ];
    }

    public function messages()
    {
        return [
            'code.max' => 'Code cannot be more then 10 characters.',
            'code.required' => 'Code field is required',
            'type.required' => 'Type field is required',
            'value.required' => 'Value field is required',
            'value.integer' => 'Value must be integer.',
            'star_date.required' => 'Start date field is required',
            'number_of' => 'Number of coupon field is required',
        ];
    }
}
