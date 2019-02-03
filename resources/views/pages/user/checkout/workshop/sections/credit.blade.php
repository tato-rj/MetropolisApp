<form id="form-credit" method="POST" action="{{route('workshops.purchase', $workshop->slug)}}">
	@csrf

	<input type="hidden" name="description" value="{{$workshop->name}}">
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
		<input type="checkbox" class="custom-control-input" name="save_card" id="save_card">
		<label class="custom-control-label" for="save_card">Lembrar os meus dados para reservas mais rápidas</label>
	</div>
</form>
