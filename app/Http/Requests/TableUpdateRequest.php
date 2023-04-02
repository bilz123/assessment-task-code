<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class TableUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('table.update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        //dd($request->route('table'));
        return [
            'number' => 'required|integer|unique:tables,number,'.$request->route('table').',uuid',
            'capacity' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'number.required' => 'Number field is required.',
            'number.string' => 'Number field must be a integer.',
            'number.unique' => 'This table is already added.',
            'capacity.required' => 'Capacity field is required.',
            'capacity.string' => 'Capacity field must be a integer.',
        ];
    }
}
