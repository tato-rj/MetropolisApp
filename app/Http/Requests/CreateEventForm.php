<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'creator_id' => 'required',
            'space_id' => 'required|exists:spaces,id',
            'participants' => 'required|integer',
            'duration' => 'required|integer',
            'date' => 'required',
            'time' => 'required'
        ];
    }
}
