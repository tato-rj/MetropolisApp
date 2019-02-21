<?php

namespace App\Traits;

use App\Http\Requests\CreditCardForm;

trait HasCreditCard
{
	protected $cardFields = [
			'card_hash', 
			'card_token', 
			'card_holder_name',
			'card_brand',
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
		return $this->card_hash;
	}

	public function updateCard(CreditCardForm $form)
	{
		$this->card_lastfour = substr($form->card_number, -4);

		foreach ($this->cardFields as $field) {
			$this->$field = $form->$field;
			// $this->$field = $form->$field ? encrypt($form->$field) : null;
		}

		return $this->save();
	}

	public function removeCard()
	{
		$this->card_lastfour = null;
		
		foreach ($this->cardFields as $field) {
			$this->$field = null;
		}

		return $this->save();
	}

	public function card($field)
	{
		if (! in_array($field, $this->cardFields))
			return null;

		return $field;
		// try {
		// 	return decrypt($this->$field);		
		// } catch (\Exception $e) {
		// 	return null;
		// }
	}
}
