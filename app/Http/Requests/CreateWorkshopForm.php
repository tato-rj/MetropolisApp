<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateWorkshopForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->guard('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:4|unique:workshops',
            'headline' => 'required|max:255',
            'description' => 'required',
            'cover_image' => 'required',
            'starts_at' => 'required|date',
            'ends_at' => 'required|date'
        ];
    }
}
