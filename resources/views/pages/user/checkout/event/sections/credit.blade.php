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
	
	<div class="form-group">
		<label class="control-label" for="card_holder_cpf"><small>CPF do titular do cartão</small></label>
		<input required type="text" class="form-control" name="card_holder_cpf" id="card_holder_cpf" placeholder="CPF do titular do cartão">
	</div>

	<div class="form-group">
		<label class="control-label"><small>Endereço</small></label>
		<div class="form-row">
			<div class="col-6 mb-2">
				<input required type="text" class="form-control" name="address_street" placeholder="Nome da rua" value="">
			</div>
			<div class="col-3 mb-2">
				<input required type="text" class="form-control" name="address_number" placeholder="Número" value="">				
			</div>
			<div class="col-3 mb-2">
				<input required type="text" class="form-control" name="address_complement" placeholder="Complemento" value="">				
			</div>
		</div>
		<div class="form-row">
			<div class="col-6 mb-2">
				<select class="form-control" name="address_state" required>
					<option>Estado</option>
				</select>
			</div>
			<div class="col-6">
				<select class="form-control" name="address_city" required>
					<option>Cidade</option>
				</select>
			</div>
			<div class="col-6 mb-2">
				<input required type="text" class="form-control" name="address_district" placeholder="Bairro" value="">				
			</div>
			<div class="col-6 mb-2">
				<input required type="text" class="form-control" name="address_zip" placeholder="CEP" value="">				
			</div>
		</div>
	</div>

	<div class="custom-control custom-checkbox mt-4">
		<input type="checkbox" class="custom-control-input" name="remembercard" id="remembercard">
		<label class="custom-control-label" for="remembercard">Lembrar os meus dados para reservas mais rápidas</label>
	</div>
</form>
