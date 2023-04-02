<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('event.add');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'poster' => 'required|file|mimes:jpg,png,gif,svg|max:2560', // 1024 KB = 1 MB
            'name' => 'required|string|max:50',
            'start_date' => 'required|before_or_equal:end_date',
            'end_date' => 'required|after_or_equal:start_date',
            'price' => 'required|integer|min:1',
            'tickets' => 'required|integer|min:-1',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'poster.size' => 'Poster must be less then 2.5MB.',
            'name.required' => 'Name field is required.',
            'name.string' => 'Name field must be a string.',
            'name.max' => 'Name cannot be more then 50 characters.',
            'start_date.required' => 'Start date field is required.',
            'end_date.required' => 'End date field is required.',
            'tickets.required' => 'Ticket field is required.',
            'tickets.integer' => 'Ticket value must be integer.',
            'price.required' => 'Price field is required.',
            'price.integer' => 'Price value must be integer.',
            'description.required' => 'Description field is required.',
        ];
    }
}
