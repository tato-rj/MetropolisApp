<div class="border px-4 py-3 bg-white shadow-sm">
	<div class="text-center mt-4">
		<img src="{{asset('images/brand/logo.svg')}}" width="90">
	</div>
	<div class="p-5">
		<h6><strong>Olá <span id="preview-recipient_name"></span></strong></h6>
		<p class="text-muted">Você está recebendo este email para pagar uma cobrança do escritório MetropolisRio.</p>

		<div class="p-4 text-muted mb-3" style="background-color: #EDEFF2">
			<p class="mb-1"><strong>Para que é esta cobrança?</strong></p>
			<p id="preview-name"><i>...</i></p>
			<p class="mb-1"><strong>Um pouco mais sobre este evento</strong></p>
			<p id="preview-description">...</p>
			<p class="mb-1"><strong>Valor</strong></p>
			<p class="m-0">R$ <span id="preview-fee">0</span>,00</p>
		</div>

		<p class="text-muted">Se você não estava esperando por esta mensagem ou encontrou algum erro, por favor entre em contato conosco. Caso contrário, clique no botão abaixo para prosseguir com o pagamento.</p>
		
		<div class="text-center mt-4">
			<button class="btn btn-red"><strong>Pagar agora</strong></button>
		</div>
	</div>
</div>