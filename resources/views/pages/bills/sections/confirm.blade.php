<div class="mb-4">
	<div class="bg-light border-top border-teal-light border-1x mb-2">
		<ul class="list-flat p-4" id="review">
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Nome</strong></span>
				<span>{{$bill->name}}</span>
			</li>
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Descrição</strong></span>
				<span>{{$bill->description}}</span>
			</li>
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Cobrança enviada para</strong></span>
				<span>{{$bill->recipient_name}}</span>
			</li>
		</ul>
		<div class="bg-teal text-white d-flex flex-wrap">
			<div class="p-3 flex-grow"><strong>INVESTIMENTO TOTAL</strong></div>
			<div class="d-flex xs-w-100">
				<div class="p-3 bg-teal-dark flex-grow"><strong>{{feeToString($bill->fee)}}</strong></div>
			</div>
			<button id="submit" data-target="#form-credit" class="p-3 btn btn-red btn-block font-weight-bold">CONFIRMAR PAGAMENTO</button>
		</div>
	</div>
	<div class="px-2">
		<small>Ao finalizar o pagamento, você concorda com os <a class="link-default" href="#">Termos de uso</a>. Política de Privacidade © Metropolis Rio. Todos os direitos reservados.</small>
	</div>
</div>