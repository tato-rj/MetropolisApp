@extends('layouts.app')

@push('header')
<script>
    window.pagseguro = <?php echo json_encode([
        'id' => $pagseguro->session->getResult()
    ]); ?>
</script>
@endpush

@section('content')

@include('pages.user.checkout._lead', ['image' => 'images/workstation.jpg'])

<div class="container my-5">
	<div class="row">
		<div class="col-default mb-4">
			<div class="text-center mb-4">
				<p class="lead">Escolha a sua forma de pagamento</p>
			</div>

			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link text-dark font-weight-bold rounded-0 active" data-form="#form-credit" id="credit-tab" data-toggle="tab" href="#credit" role="tab">Cartão de Crédito</a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-dark font-weight-bold rounded-0" data-form="#form-debit" id="debit-tab" data-toggle="tab" href="#debit" role="tab">Cartão de Débito</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane mt-3 fade show active" id="credit" role="tabpanel" aria-labelledby="credit-tab">
					@include('pages.user.checkout.event.sections.credit')
				</div>
				<div class="tab-pane mt-3 fade" id="debit" role="tabpanel" aria-labelledby="debit-tab">
					@include('pages.user.checkout.event.sections.debit')
				</div>
			</div>
			<div class="text-right mt-2">
				@include('components.form.payment.pagseguro-logo')
			</div>
		</div>
		<div class="col-default">
			@include('pages.user.checkout.event.sections.confirm')
		</div>
	</div>
</div>

@if ($errors->any())
	@include('components.alerts.error', ['message' => 'Não foi possível realizar o seu pedido nesse momento. Verifique se o formulário foi corretamente preenchido e tente novamente.'])
@endif


@endsection

@push('scripts')
<script type="text/javascript" src="https://stc{{pagseguro('env') == 'sandbox' ? '.sandbox' : null}}.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
<script type="text/javascript" src="{{mix('js/pagseguro.js')}}"></script>

@endpush