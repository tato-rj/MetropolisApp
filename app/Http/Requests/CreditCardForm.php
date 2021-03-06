<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreditCardForm extends FormRequest
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

    public function prepareFields()
    {
        $form->card_holder_document_value = clean($form->card_holder_document_value);
        $form->address_zip = clean($form->address_zip);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'card_hash' => 'required',
            'card_token' => 'required',
            'card_holder_name' => 'required',
            'card_holder_document_type' => 'sometimes',
            'card_holder_document_value' => 'sometimes',
            'address_zip' => 'sometimes',
            'address_street' => 'sometimes|min:4',
            'address_district' => 'sometimes',
            'address_city' => 'sometimes',
            'address_state' => 'sometimes'
        ];
    }
}
