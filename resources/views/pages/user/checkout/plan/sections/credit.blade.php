<form id="form-credit" method="POST" action="{{route('client.plan.subscribe')}}">
	@csrf
	{{-- PLAN --}}
	<input type="hidden" name="plan_id" value="{{$plan->id}}">
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
