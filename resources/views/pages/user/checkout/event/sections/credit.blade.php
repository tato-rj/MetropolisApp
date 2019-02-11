<form id="form-credit" method="POST" action="{{route('client.events.purchase')}}">
	@csrf
	{{-- EVENT --}}
	<input type="hidden" name="type" value="{{$form->type}}">
	@if($form->emails)
	@foreach($form->emails as $email)
	<input type="hidden" name="emails[]" value="{{$email}}">
	@endforeach
	@endif
	<input type="hidden" name="description" value="{{$form->space->name}}">
	<input type="hidden" name="date" value="{{$form->date}}">
	<input type="hidden" name="time" value="{{$form->time}}">
	<input type="hidden" name="duration" value="{{$form->duration}}">
	<input type="hidden" name="participants" value="{{$form->participants}}">
	{{-- <input type="hidden" name="price" value="{{$form->space->priceFor($form->participants, $form->duration, auth()->user()->bonusesLeft($form->space))}}"> --}}

	<input type="hidden" name="paymentMethod" value="creditCard">
	<input type="hidden" name="card_token">
	<input type="hidden" name="card_hash">
	<input type="hidden" name="card_brand">

	<div class="form-group d-flex flex-wrap cards">
		<p class="m-0 text-muted text-center mt-2 mb-0 w-100"><i>Carregando cartões aceitos...</i></p>
	</div>

	@include('components.form.payment.credit-card')

</form>
