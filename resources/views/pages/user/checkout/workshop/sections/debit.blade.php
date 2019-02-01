<form id="form-debit" method="POST" action="{{route('workshops.purchase', $workshop->slug)}}">
	@csrf

	<input type="hidden" name="description" value="{{$workshop->name}}">
	<input type="hidden" name="paymentMethod" value="eft">
	<input type="hidden" name="card_token">
	<input type="hidden" name="card_hash">
	<input type="hidden" name="card_brand">
	<input type="hidden" name="card_lastfour">

	<div class="form-group d-flex flex-wrap cards">
		<p class="m-0 text-muted text-center mt-2 mb-0 w-100"><i>Carregando cartões aceitos...</i></p>
	</div>

	<div class="form-group">
		<label class="control-label" for="card_holder_name"><small>Nome no cartão</small></label>
		<input required type="text" class="form-control" name="card_holder_name" id="card_holder_name" placeholder="Nome no cartão">
	</div>

	<div class="form-row">
		<div class="col-8">
			<div class="form-group">
				<label class="control-label" for="card_number"><small>Número do cartão</small></label>
				<input required type="text" maxlength="19" class="form-control" name="card_number" id="card_number" placeholder="Número do cartão" 
					style="background: url({{asset('images/icons/credit.png')}}) no-repeat 0rem .3rem; background-size: 3.85rem; padding-left: 3.75rem;">
				<label class="text-danger m-0" id="card-invalid" style="display: none;"><small>O número do cartão é inválido</small></label>
			</div>
		</div>
		<div class="col-4">
			<label class="control-label" for="cvv"><small>Código de segurança</small></label>
			<div class="d-flex">
				<input required type="text" class="form-control" maxlength="4" name="cvv" id="cvv" placeholder="CVV">
				<img src="{{asset('images/icons/cvv.png')}}" height="38" class="ml-2">
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label" for="expiry_month"><small>Data de validade</small></label>
		<div class="form-row">
			<div class="col-6">
				<select required class="form-control" name="expiry_month" id="expiry_month">
					<option>Mês</option>
					<option value="01">01 - Janeiro</option>
					<option value="02">02 - Fevereiro</option>
					<option value="03">03 - Março</option>
					<option value="04">04 - Abril</option>
					<option value="05">05 - Maio</option>
					<option value="06">06 - Junho</option>
					<option value="07">07 - Julho</option>
					<option value="08">08 - Agosto</option>
					<option value="09">09 - Setembro</option>
					<option value="10">10 - Outubro</option>
					<option value="11">11 - Novembro</option>
					<option value="12">12 - Dezembro</option>
				</select>
			</div>
			<div class="col-6">
				<select required class="form-control" name="expiry_year">
					<option>Ano</option>
					@for($i=0; $i<12; $i++)
					<option value="{{now()->copy()->addYear($i)->year}}">{{now()->copy()->addYear($i)->year}}</option>
					@endfor
				</select>
			</div>
		</div>
	</div>

	<div class="custom-control custom-checkbox mt-4">
		<input type="checkbox" class="custom-control-input" name="remembercard" id="remembercard">
		<label class="custom-control-label" for="remembercard">Lembrar os meus dados para reservas mais rápidas</label>
	</div>

	<div class="alert alert-grey my-4" role="alert">
		<p class="mb-1"><strong>Cartão de Débito</strong></p>
		<p class="m-0">Aceitamos os principais cartões de débito. No entanto, alguns bancos ainda não realizam pagamento online por cartão de débito. Para mais informações, entre em contato com o seu banco.</p>
	</div>
</form>
