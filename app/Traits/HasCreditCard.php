<?php

namespace App\Traits;

use App\Http\Requests\CreditCardForm;

trait HasCreditCard
{
	protected $cardFields = [
			'card_holder_name', 
			'card_number', 
			'card_brand',
			'cvv', 
			'expiry_month', 
			'expiry_year', 
			'card_holder_document_type', 
			'card_holder_document_value', 
			'address_zip', 
			'address_street', 
			'address_number', 
			'address_complement', 
			'address_district', 
			'address_city', 
			'address_state'];

	public function getHasCardAttribute()
	{
		return $this->card_number && $this->cvv;
	}

	public function updateCard(CreditCardForm $form)
	{
		foreach ($this->cardFields as $field) {
			$this->$field = $form->$field ? encrypt($form->$field) : null;
		}

		return $this->save();
	}

	public function card($field)
	{
		if (! in_array($field, $this->cardFields))
			return null;

		try {
			return decrypt($this->$field);		
		} catch (\Exception $e) {
			return null;
		}
	}
}
