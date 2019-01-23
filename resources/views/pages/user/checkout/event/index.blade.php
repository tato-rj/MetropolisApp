@extends('layouts.app')

@push('header')
<script>
    window.pagseguro = <?php echo json_encode([
        'id' => $pagseguroId
    ]); ?>
</script>
@endpush

@section('content')

@include('pages.user.checkout.event.sections._lead')

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
				@include('pages.user.checkout.event.sections.pagseguro')
			</div>
		</div>
		<div class="col-default">
			@include('pages.user.checkout.event.sections.confirm')
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('input[name="card_holder_cpf"]').inputmask("999.999.999-99");
  $('input[name="card_number"]').inputmask("9999 9999 9999 9999");
  $('input[name="cvv"]').inputmask("999[9]");  
});
</script>
<script type="text/javascript">
jQuery.fn.cleanVal = function() {
	return this.val().replace(/\D/g,'');
};

$('#review #date').text(
	moment(
		$('#review #date').attr('data-date')
	).locale('pt').format("D [de] MMMM [de] YYYY")
);

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  $('button#submit').attr('data-target', $(e.target).attr('data-form'));
})

$(document).ready(function(){
	PagSeguroDirectPayment.setSessionId(pagseguro.id);

	PagSeguroDirectPayment.getPaymentMethods({
		amount: 500.00,
		success: function(data) {
			console.log(data);
			
			$('#form-credit .cards, #form-debit .cards').html('');

			$.each(data.paymentMethods.CREDIT_CARD.options, function(i, obj) {
				$('#form-credit .cards').append('<div class="m-1"><img src="https://stc.pagseguro.uol.com.br/'+obj.images.MEDIUM.path+'"></div>');
			});

			// $('#deposit').append('<div><img src="https://stc.pagseguro.uol.com.br/'+data.paymentMethods.BOLETO.options.BOLETO.images.SMALL.path+'">'+data.paymentMethods.BOLETO.options.BOLETO.displayName+'</div>');

			$.each(data.paymentMethods.ONLINE_DEBIT.options, function(i, obj) {
				$('#form-debit .cards').append('<div class="m-1"><img src="https://stc.pagseguro.uol.com.br/'+obj.images.MEDIUM.path+'"></div>');
			});
		},
		error: function(data) {
			console.log('NO...');
		},
		complete: function(data) {
			console.log(data);
		}
	});

	// PREPARE STATE NAMES


});

function getCardFlag(input, cardNumber, form)
{
	PagSeguroDirectPayment.getBrand({
		cardBin: cardNumber,
		success: function(response) {
			let icon = response.brand.name;
			input.css('background-image', 'url(https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/'+icon+'.png)');
			form.find('input[name="card_brand"]').val(icon);
			form.find('#card-invalid').hide();
		},
		error: function() {
			input.css('background-image', 'url(http://metropolis.test/images/icons/credit.png)');
			form.find('input[name="card_brand"]').val('');
			form.find('#card-invalid').show();
		},
		complete: function(response) {
			console.log(response);
		}
	});
}

$('input[name="card_number"]').on('blur', function() {
	let input = $(this);
	let cardNumber = input.cleanVal();
	let $form = $($('button#submit').attr('data-target'));

	if (cardNumber.length >= 6) {
		getCardFlag(input, cardNumber, $form);
	}
});

$('input[name="card_number"]').on('keyup', function() {
	let input = $(this);
	let cardNumber = input.cleanVal();
	let $form = $($('button#submit').attr('data-target'));

	if (cardNumber.length == 6) {
		getCardFlag(input, cardNumber, $form);
	} else if (cardNumber.length < 6) {
		input.css('background-image', 'url(http://metropolis.test/images/icons/credit.png)');
		$form.find('input[name="card_brand"]').val('');
		$form.find('#card-invalid').hide();
	}

});

$('button#submit').on('click', function(event) {
	let $button = $(this);
	let $form = $($button.attr('data-target'));
	let buttonOriginalText = $button.text();

	$button.prop('disabled', true);
	$button.text('PROCESSANDO O SEU PEDIDO...');

	PagSeguroDirectPayment.createCardToken({
		cardNumber: $form.find('input[name="card_number"]').cleanVal(),
		brand: $form.find('input[name="card_brand"]').val(),
		cvv: $form.find('input[name="cvv"]').val(),
		expirationMonth: $form.find('select[name="expiry_month"] option:selected').val(),
		expirationYear: $form.find('select[name="expiry_year"] option:selected').val(),
		success: function (response) {
			let cardLastfour = $form.find('input[name="card_number"]').val().substr($form.find('input[name="card_number"]').val().length - 4);
			$form.find('input[name="card_token"]').val(response.card.token);
			$form.find('input[name="card_lastfour"]').val(cardLastfour);

			PagSeguroDirectPayment.onSenderHashReady(function(response){
				if(response.status == 'error') {
					console.log(response.message);
					return false;
				}

				$form.find('input[name="card_hash"]').val(response.senderHash);

				$form.submit();
			});
		},
		error: function (response) {
			alert(showError(response));
			console.log(response);
			$button.prop('disabled', false);
			$button.text(buttonOriginalText);
		}
	});

});

function showError(response) {
	return ucfirst(errors[Object.keys(response.errors)[0]]);
}

function ucfirst(string) 
{
    return string.charAt(0).toUpperCase() + string.slice(1);
}

let errors = {
      'bad_request': 'O pagamento não pode ser processado',
      '5003': 'falha de comunicação com a instituição financeira',
      '10000': 'bandeira inválida',
      '10001': "número do cartão inválido",
      '10002': "data no formato inválido",
      '10003': "código de segurança inválido",
      '10004': "cvv obrigatório",
      '10006': "código de segurança inválido",
      '53004': "quantidade de ítens inválido",
      '53005': "moeda obrigatória",
      '53006': "moeda inválida",
      '53007': "tamanho do campo referência inválido",
      '53008': "url de notificação inválida",
      '53009': "tamanho da url de notificação inválida",
      '53010': "email do comprador inválido.",
      '53011': "email do comprador inválido",
      '53012': "tamanho do campo email do comprador inválido",
      '53013': "nome do comprador obrigatório",
      '53014': "nome do comprador inválido",
      '53015': "tamanho do campo nome do comprador inválido",
      '53017': "cpf do comprador inválido",
      '53018': "código de área do telefone inválido",
      '53019': "tamanho do campo código de área do telefone inválido",
      '53020': "telefone obrigatório",
      '53021': "telefone inválido",
      '53022': "CEP obrigatório",
      '53023': "CEP inválido",
      '53024': "rua do endereço obrigatório",
      '53025': "rua do endereço inválido",
      '53026': "número do endereço obrigatório",
      '53027': "número do endereço inválido",
      '53028': "complemento do endereço inválido",
      '53029': "bairro do endereço obrigatório",
      '53030': "bairro do endereço inválido",
      '53031': "cidade do endereço obrigatória",
      '53032': "cidade do endereço inválida",
      '53033': "estado do endereço obrigatório",
      '53034': "estado do endereço inválido",
      '53035': "país do endereço obrigatório.",
      '53036': "país do endereço inválido",
      '53037': "token do cartão de crédito obrigatório",
      '53038': "quantidade de parcelas obrigatória",
      '53039': "quantidade de parcelas inválida",
      '53040': "valor da parcela obrigatória",
      '53041': "valor da parcela inválida",
      '53042': "portador do cartão obrigatório",
      '53043': "portador do cartão inválido",
      '53044': "tamanho do campo portador do cartão inválido",
      '53045': "CPF do portador do cartão obrigatório",
      '53046': "CPF do portador do cartão inválido",
      '53047': "data de nascimento do portador do cartão obrigatório",
      '53048': "data de nascimento do portador do cartão inválido",
      '53049': "código de área do portador do cartão obrigatório",
      '53050': "código de área do portador do cartão inválido",
      '53051': "telefone do portador do cartão obrigatório",
      '53052': "telefone  do portador do cartão inválido",
      '53053': "CEP do portador do cartão obrigatório",
      '53054': "CEP do portador do cartão inválido",
      '53055': "rua do portador do cartão obrigatório",
      '53056': "rua do portador do cartão inválido",
      '53057': "número do endereço do portador do cartão obrigatório",
      '53058': "número do endereço do portador do cartão inválido",
      '53059': "tamanho do campo complemento do endereço do portador do cartão inválido",
      '53060': "bairro do portador do cartão obrigatório",
      '53061': "tamanho do campo bairro do portador do cartão inválido",
      '53062': "cidade do portador do cartão obrigatório",
      '53063': "tamanho do campo cidade do portador do cartão inválido",
      '53064': "estado do portador do cartão obrigatório",
      '53065': "estado do portador do cartão inválido",
      '53066': "país do portador do cartão obrigatório",
      '53067': "tamanho do campo país do portador do cartão inválido",
      '53068': "tamanho do email do vendedor inválido",
      '53069': "email do vendedor inválido",
      '53070': "código do ítem obrigatório",
      '53071': "tamanho do código do ítem inválido",
      '53072': "descrição do ítem obrigatório",
      '53073': "tamanho do campo ítem inválido",
      '53074': "quantidade de ítens obrigatória",
      '53075': "quantidade de ítens fora do limite",
      '53076': "quantidade de ítens inválido",
      '53077': "montante do ítem obrigatório",
      '53078': "montante do ítem inválido.",
      '53079': "montante fora do limite",
      '53081': "comprador é igual ao vendedor",
      '53084': "vendedor inválido, verifique se é uma conta com status de vendedor",
      '53085': "método de pagamento indisponível",
      '53086': "montante total acima do limite do cartão",
      '53087': "dados do cartão inválidos",
      '53091': "hash do comprador inválido",
      '53092': "bandeira do cartão não aceita",
      '53095': "tipo de entrega inválido",
      '53096': "custo de entrega inválido",
      '53097': "custo da entrega fora do limite",
      '53098': "valor total é negatívo",
      '53099': "montante extra inválido.",
      '53101': "modo de pagamento inválido, valores válidos são default e gateway",
      '53102': "método de pagamento inválido, valores válidos são creditCard, boleto e eft",
      '53104': "custo de entrega informado, endereço de entrega deve ser completo",
      '53105': "informações do comprador informado, email também deve ser informado",
      '53106': "portador do cartão incompleto",
      '53109': "endereço do comprador informado, email do comprador também deve ser informado",
      '53110': "banco eft obrigatório",
      '53111': "banco eft não aceito",
      '53115': "data de nascimento do comprador inválida",
      '53117': "CPNJ do comprador inválido",
      '53122': "domínio do email do comprador inválido. Você deve usar um email @sandbox.pagseguro.com.br",
      '53140': "quantidade de parcelas fora do limite. O valor deve ser maior que zero",
      '53141': "comprador bloqueado",
      '53142': "token do cartão de crédito inválido",
      '14007': "status da transação não permite reembolso"
};

function getStates(){
	$.ajax({
		type:'GET',
		url:'http://api.londrinaweb.com.br/PUC/Estados/BR/0/10000',
		contentType: "application/json; charset=utf-8",
		dataType: "jsonp",
		async:false
	}).done(function(response){
		estados='';

		$.each(response, function(e, estado){

			estados+='<option value="'+estado.UF+'">'+estado.Estado+'</option>';

		});

		// PREENCHE OS ESTADOS BRASILEIROS
		$('select[name="address_state"]').append(estados);

		// VERIFICA A MUDANÇA NO VALOR DO CAMPO ESTADO E ATUALIZA AS CIDADES
		$('select[name="address_state"]').change(function(){
			getCities($(this).val());
		});

	});
}

function getCities(estado){
	$.ajax({
		type:'GET',
		url:'http://api.londrinaweb.com.br/PUC/Cidades/'+estado+'/BR/0/10000',
		contentType: "application/json; charset=utf-8",
		dataType: "jsonp",
		async:false
	}).done(function(response){
		cidades='<option>Cidade</option>';

		$.each(response, function(c, cidade){

			cidades+='<option value="'+cidade+'">'+cidade+'</option>';

		});

		// PREENCHE AS CIDADES DE ACORDO COM O ESTADO
		$('select[name="address_city"]').html(cidades);

	});
}

getStates();
</script>
@endpush