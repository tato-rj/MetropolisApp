<div class="form-group">
	<label class="control-label" for="card_holder_name"><small>Nome no cartão</small></label>
	<input required type="text" class="form-control" name="card_holder_name" id="card_holder_name" placeholder="Nome no cartão" value="{{old('card_holder_name')}}">
</div>

<div class="form-row">
	<div class="col-8">
		<div class="form-group">
			<label class="control-label" for="card_number"><small>Número do cartão</small></label>
			<input required type="text" maxlength="19" class="form-control" name="card_number" id="card_number" placeholder="Número do cartão" 
				style="background: url({{asset('images/icons/credit.png')}}) no-repeat 0rem .3rem; background-size: 3.85rem; padding-left: 3.75rem;">
			<label class="text-success m-0 card-validation" id="card-valid" style="display: none;"><small><i class="fas fa-check mr-1"></i>Cartão validado com sucesso</small></label>
			<label class="text-muted m-0 card-validation" id="card-validating" style="display: none;"><small><i>Validando o número do cartão</i></small></label>
			<label class="text-danger m-0 card-validation" id="card-invalid" style="display: none;"><small>O número do cartão é inválido</small></label>
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
				<option value="01" @old('expiry_month', '01') selected @endold>01 - Janeiro</option>
				<option value="02" @old('expiry_month', '02') selected @endold>02 - Fevereiro</option>
				<option value="03" @old('expiry_month', '03') selected @endold>03 - Março</option>
				<option value="04" @old('expiry_month', '04') selected @endold>04 - Abril</option>
				<option value="05" @old('expiry_month', '05') selected @endold>05 - Maio</option>
				<option value="06" @old('expiry_month', '06') selected @endold>06 - Junho</option>
				<option value="07" @old('expiry_month', '07') selected @endold>07 - Julho</option>
				<option value="08" @old('expiry_month', '08') selected @endold>08 - Agosto</option>
				<option value="09" @old('expiry_month', '09') selected @endold>09 - Setembro</option>
				<option value="10" @old('expiry_month', '10') selected @endold>10 - Outubro</option>
				<option value="11" @old('expiry_month', '11') selected @endold>11 - Novembro</option>
				<option value="12" @old('expiry_month', '12') selected @endold>12 - Dezembro</option>
			</select>
		</div>
		<div class="col-6">
			<select required class="form-control" name="expiry_year">
				<option>Ano</option>
				@for($i=0; $i<12; $i++)
				<option value="{{now()->copy()->addYear($i)->year}}" @old('expiry_year', now()->copy()->addYear($i)->year) selected @endold>
					{{now()->copy()->addYear($i)->year}}
				</option>
				@endfor
			</select>
		</div>
	</div>
</div>

<div class="form-group">
	@if(request()->has('plan_id'))
		@include('components.form.payment.document.any')
	@else
		@include('components.form.payment.document.cpf')
	@endif
</div>

<div class="form-group mb-3">
	<label class="control-label"><small>Endereço</small></label>
	<div class="form-row">
		<div class="col-6 mb-2">
			<input required type="text" class="form-control" name="address_zip" placeholder="CEP" value="{{old('address_zip')}}">				
		</div>
		<div class="col-6 mb-2 text-center">
			<div class="alert-green h-100 zip-alert" id="zip-valid" style="display: none;">
				<div class="d-inline-block" style="vertical-align: -webkit-baseline-middle;">CEP válido!</div>
			</div>
			<div class="alert-red h-100 zip-alert" id="zip-invalid" style="display: none;">
				<div class="d-inline-block" style="vertical-align: -webkit-baseline-middle;">CEP não encontrado</div>
			</div>
		</div>
	</div>
	<div class="form-row address-fields">
		<div class="col-6 mb-2">
			<input required type="text" class="form-control" name="address_street" placeholder="Nome da rua" value="{{old('address_street')}}">
		</div>
		<div class="col-3 mb-2">
			<input type="text" class="form-control" name="address_number" placeholder="Número" value="{{old('address_number')}}">				
		</div>
		<div class="col-3 mb-2">
			<input type="text" class="form-control" name="address_complement" placeholder="Complemento" value="{{old('address_complement')}}">				
		</div>
	</div>
	<div class="form-row address-fields">
		<div class="col-6 mb-2">
			<input required type="text" class="form-control" name="address_district" placeholder="Bairro" value="{{old('address_district')}}">				
		</div>
		<div class="col-3 mb-2">
			<input required type="text" class="form-control" name="address_state" placeholder="Estado" value="{{old('address_state')}}">
		</div>
		<div class="col-3">
			<input required type="text" class="form-control" name="address_city" placeholder="Cidade" value="{{old('address_city')}}">				
		</div>
	</div>
</div>

<div class="custom-control custom-checkbox mb-3">
	<input type="checkbox" class="custom-control-input" name="save_card" id="save_card">
	<label class="custom-control-label" for="save_card">Lembrar os meus dados para reservas mais rápidas</label>
</div>