<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
        $unique = Rule::unique('events')->ignore($this->event);
        return [
            'name'          => 'required|string|max:255|'.$unique,
            'description'   => 'required',
            'place'         => 'required|string|max:255',
            'location'      => 'required|string|max:255',
            'status'        => 'required|boolean',
            'date_start'    => 'required|date_format:Y-m-d',
            'time_start'    => 'required|date_format:H:i:s',
            'date_end'      => 'required|date_format:Y-m-d',
            'time_end'      => 'required|date_format:H:i:s',
        ];
    }
}
