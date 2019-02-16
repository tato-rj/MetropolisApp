@if(auth()->guard('web')->check() && auth()->user()->hasCard)
<div class="accordion mt-5 mb-4" id="card-preference">

  <div class="bg-light border-top border-x px-4 py-3"><i class="fas fa-credit-card mr-2 text-grey"></i>Você tem um cartão de crédito salvo. O que gostaria de fazer?</div>
  <div class="card">
    <div class="px-4 py-3 d-apart">
  		<div class="custom-control custom-radio custom-control-inline" data-toggle="collapse" data-target="#existing-card">
  		  <input type="radio" id="existing-card-radio" name="select-card" data-url="{{route('client.payments.load-fields', ['fields' => 'existing'])}}" class="custom-control-input">
  		  <label class="custom-control-label" for="existing-card-radio">
  		  	Vou usar o cartão 
  		  	@include('components.form.payment.card-preview', ['user' => auth()->user()])
  		  </label>
  		</div>
      <div class="loading-icons">
        <div class="text-grey" style="display: none;"><i class="fas fa-hourglass-half"></i></div>
        <div class="text-green" style="display: none;"><i class="fas fa-check-circle"></i></div>
      </div>
    </div>

    <div id="existing-card" class="collapse" data-parent="#card-preference">

      {{-- LOAD EXISTING CARD FIELDS HERE WITH AJAX --}}

    </div>
  </div>
  <div class="card">
    <div class="px-4 py-3 d-apart">
  		<div class="custom-control custom-radio custom-control-inline" data-toggle="collapse" data-target="#new-card">
  		  <input type="radio" id="new-card-radio" name="select-card" data-url="{{route('client.payments.load-fields', ['fields' => 'new'])}}" class="custom-control-input">
  		  <label class="custom-control-label" for="new-card-radio">Prefiro usar um cartão novo</label>
  		</div>
      <div class="loading-icons">
        <div class="text-grey" style="display: none;"><i class="fas fa-hourglass-half"></i></div>
        <div class="text-green" style="display: none;"><i class="fas fa-check-circle"></i></div>
      </div>
    </div>
    <div id="new-card" class="collapse px-3" data-parent="#card-preference">
      
      {{-- LOAD NEW CARD INPUTS HERE WITH AJAX --}}

    </div>
  </div>

</div>
@else

	@include('components.form.payment.fields.new')

@endif