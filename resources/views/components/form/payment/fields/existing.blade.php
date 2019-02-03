<input type="hidden" name="card_holder_name" value="{{auth()->user()->card('card_holder_name')}}">
<input type="hidden" name="card_number" value="{{auth()->user()->card('card_number')}}">
<input type="hidden" name="cvv" value="{{auth()->user()->card('cvv')}}">
<select style="display: none;" name="expiry_month">
	<option value="{{auth()->user()->card('expiry_month')}}" selected></option>
</select>
<select style="display: none;" name="expiry_year">
	<option value="{{auth()->user()->card('expiry_year')}}" selected></option>
</select>
<input type="hidden" name="card_holder_document_type" value="{{auth()->user()->card('card_holder_document_type')}}">
<input type="hidden" name="card_holder_document_value" value="{{auth()->user()->card('card_holder_document_value')}}">
<input type="hidden" name="address_zip" value="{{auth()->user()->card('address_zip')}}">
<input type="hidden" name="address_street" value="{{auth()->user()->card('address_street')}}">
<input type="hidden" name="address_number" value="{{auth()->user()->card('address_number')}}">
<input type="hidden" name="address_complement" value="{{auth()->user()->card('address_complement')}}">
<input type="hidden" name="address_district" value="{{auth()->user()->card('address_district')}}">
<input type="hidden" name="address_state" value="{{auth()->user()->card('address_state')}}">
<input type="hidden" name="address_city" value="{{auth()->user()->card('address_city')}}">