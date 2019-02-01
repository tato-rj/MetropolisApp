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

			@include('pages.user.checkout.plan.sections.credit')
			<div class="text-right mt-2">
				@include('pages.user.checkout.plan.sections.pagseguro')
			</div>
		</div>
		<div class="col-default">
			@include('pages.user.checkout.plan.sections.confirm')
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
<script type="text/javascript" src="{{mix('js/pagseguro.js')}}"></script>
<script type="text/javascript">
$('input[name="tipo_de_pessoa"]').on('click', function() {
	let $input = $(this);
	let target = $input.attr('data-target');
	let name = $input.attr('data-name');
	let value = $input.attr('data-value');

	$('input[name="card_holder_document_type"]').val(value);
	$('input.cpf-field, input.cnpj-field').removeAttr('name').hide();
	$(target).attr('name', name).show();
});
$('.different-billing').on('click', function() {
	$('#new-address').collapse('show');
});
</script>
@endpush