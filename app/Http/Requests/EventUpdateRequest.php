<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('event.update');
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
            'start_date' => 'required||before_or_equal:end_date',
            'end_date' => 'required|after_or_equal:start_date',
            'price' => 'integer|required|min:1',
            'tickets' => 'integer|required',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name field is required.',
            'name.string' => 'Name field must be a string.',
            'name.max' => 'Name cannot be more then 50 characters.',
            'name.max' => 'Name cannot be more then 50 characters.',
            'tickets.required' => 'Ticket field is required.',
            'tickets.integer' => 'Ticket value must be integer.',
            'price.required' => 'Price field is required.',
            'price.integer' => 'Price value must be integer.',
            'description.required' => 'Description field is required.',
        ];
    }
}
