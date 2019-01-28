<form id="form-credit" method="POST" action="{{route('client.events.purchase')}}">
	@csrf
	{{-- EVENT --}}
	<input type="hidden" name="creator_id" value="{{auth()->check() ? auth()->user()->id : null}}">
	<input type="hidden" name="space_id" value="{{$space->id}}">
	<input type="hidden" name="description" value="{{$space->name}}">
	<input type="hidden" name="date" value="{{request()->date}}">
	<input type="hidden" name="time" value="{{request()->time}}">
	<input type="hidden" name="duration" value="{{request()->duration}}">
	<input type="hidden" name="participants" value="{{request()->participants}}">
	<input type="hidden" name="price" value="{{$space->priceFor(request()->participants, request()->duration, auth()->user()->bonusesLeft($space))}}">

	<input type="hidden" name="paymentMethod" value="creditCard">
	<input type="hidden" name="card_token">
	<input type="hidden" name="card_hash">
	<input type="hidden" name="card_brand">
	<input type="hidden" name="card_lastfour">

	<div class="form-group d-flex flex-wrap cards">
		<p class="m-0 text-muted text-center mt-2 mb-0 w-100"><i>Carregando cartões aceitos...</i></p>
	</div>

	@include('components.form.payment.credit-card')

	<div class="custom-control custom-checkbox mt-4">
		<input type="checkbox" class="custom-control-input" name="remembercard" id="remembercard">
		<label class="custom-control-label" for="remembercard">Lembrar os meus dados para reservas mais rápidas</label>
	</div>
</form>
