<label class="control-label"><small>Documento</small></label>
<div>
	<div class="custom-control custom-radio">
	  <input type="radio" data-name="card_holder_document_value" name="tipo_de_pessoa" value="pessoa_fisica" data-value="CPF" data-target=".cpf-field" required 
	  	name="tipo_de_pessoa" @old('tipo_de_pessoa', 'pessoa_fisica') checked @endold id="pessoa-fisica" class="custom-control-input">
	  <label class="custom-control-label pl-1" for="pessoa-fisica">Pessoa física</label>
	</div>
	<div class="custom-control custom-radio">
	  <input type="radio" data-name="card_holder_document_value" name="tipo_de_pessoa" value="pessoa_juridica" data-value="CNPJ" data-target=".cnpj-field" required 
	  	name="tipo_de_pessoa" @old('tipo_de_pessoa', 'pessoa_juridica') checked @endold id="pessoa-juridica" class="custom-control-input">
	  <label class="custom-control-label pl-1" for="pessoa-juridica">Pessoa jurídica</label>
	</div>
</div>
<div>
	<input class="form-control" type="hidden" name="card_holder_document_type" value="{{old('tipo_de_pessoa') == 'pessoa_fisica' ? 'CPF' : 'CNPJ'}}">

	<input class="form-control mt-3 cpf-field" 
		style="display: {{old('tipo_de_pessoa') == 'pessoa_fisica' ? 'block' : 'none'}};" required type="text" 
		name="{{old('tipo_de_pessoa') == 'pessoa_fisica' ? 'card_holder_document_value' : null}}" 
		placeholder="CPF do titular do cartão" value="{{old('tipo_de_pessoa') == 'pessoa_fisica' ? old('card_holder_document_value') : null}}">
	<input class="form-control mt-3 cnpj-field" 
		style="display: {{old('tipo_de_pessoa') == 'pessoa_juridica' ? 'block' : 'none'}};" required type="text" 
		name="{{old('tipo_de_pessoa') == 'pessoa_juridica' ? 'card_holder_document_value' : null}}" 
		placeholder="CNPJ da empresa titular do cartão" value="{{old('tipo_de_pessoa') == 'pessoa_juridica' ? old('card_holder_document_value') : null}}">
</div>