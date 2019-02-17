<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Bill;

class BillPaymentForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->validateBill();
    }

    public function validateBill()
    {
        $this->bill = Bill::byReference($this->reference)->firstOrFail();
        $this->type = $this->bill->name;
        $this->user = auth()->guard('web')->user();

        return $this->bill;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'reference' => 'required|exists:bills,reference'
        ];
    }
}
