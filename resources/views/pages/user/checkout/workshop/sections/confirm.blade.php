<div class="mb-4">
	<div class="bg-light border-top border-teal-light border-1x mb-2">
		<ul class="list-flat p-4" id="review">
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Nome</strong></span>
				<span><strong>{{$workshop->name}}</strong></span>
			</li>
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Data</strong></span>
				<span class="date-pt" data-date="{{$workshop->starts_at}}"></span>
			</li>
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Horário</strong></span>
				<span>Das {{$workshop->starts_at->format('H')}} às {{$workshop->ends_at->format('H')}} horas</span>
			</li>
			<li>
				<span class="text-teal mr-1"><strong>Tem um coupon de desconto?</strong></span>
				<input type="text" placeholder="COUPON" class="text-uppercase mr-2" id="coupon" style="border: 0;
			    border-bottom: 1px solid lightgrey;
			    background: transparent;">
			    <button class="btn btn-xs btn-teal" id="validate-coupon" data-url="{{route('coupons.validate')}}">Validar coupon</button>
				<div class="valid-feedback"></div>
				<div class="invalid-feedback"></div>
			</li>
		</ul>

		@include('components.form.payment.agree')

		<div class="bg-teal text-white d-flex flex-wrap">
			<div class="p-3 flex-grow"><strong>INVESTIMENTO TOTAL</strong></div>
			<div class="d-flex xs-w-100">
				<div class="p-3 bg-teal-dark flex-grow"><strong>
					@if($workshop->discount)
					<span class="opacity-6 mr-2" style="text-decoration: line-through;">
						{{feeToString($workshop->fee)}}
					</span>
					{{feeToString($workshop->discount)}}
					@else
					{{feeToString($workshop->fee)}}
					@endif
				</strong></div>
			</div>
			<button id="submit" data-target="#form-credit" class="p-3 btn btn-red btn-block font-weight-bold">CONFIRMAR RESERVA</button>
		</div>
	</div>
</div>