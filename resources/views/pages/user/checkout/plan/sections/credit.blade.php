<form id="form-credit" method="POST" action="{{route('plan.subscribe')}}">
	@csrf
	{{-- PLAN --}}
	<input type="hidden" name="plan_id" value="{{$plan->id}}">
	<input type="hidden" name="paymentMethod" value="creditCard">

	<div class="form-group d-flex flex-wrap cards">
		<p class="m-0 text-muted text-center mt-2 mb-0 w-100"><i>Carregando cartões aceitos...</i></p>
	</div>

	@include('components.form.payment.credit-card')

</form>
