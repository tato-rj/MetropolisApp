<form id="form-credit" method="POST" action="{{route('client.payments.bill.purchase')}}">
	@csrf
	{{-- EVENT --}}
	<input type="hidden" name="reference" value="{{$bill->reference}}">
	<input type="hidden" name="type" value="{{$bill->title}}">
	<input type="hidden" name="description" value="{{$bill->description}}">
	<input type="hidden" name="paymentMethod" value="creditCard">

	<div class="form-group d-flex flex-wrap cards">
		<p class="m-0 text-muted text-center mt-2 mb-0 w-100"><i>Carregando cartões aceitos...</i></p>
	</div>

	@include('components.form.payment.credit-card')

</form>
