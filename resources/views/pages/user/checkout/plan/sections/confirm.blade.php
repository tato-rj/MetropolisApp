<div class="mb-4">
	<div class="bg-light border-top border-teal-light border-1x mb-4">
		<ul class="list-flat p-4" id="review">
				<div class="mb-3">
					<p class="text-muted mb-1"><strong>Plano {{ucfirst($selectedPlan->type)}}</strong></p>
					<h2 class="text-{{$selectedPlan->color}} m-0"><strong>{{ucfirst($selectedPlan->name)}}</strong></h2>
				</div>
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Data de início</strong></span>
				<span>{{toFormattedDateStringPt(now())}}</span>
			</li>
			<li>
				<span class="text-teal mr-1"><strong>Renovação automática a cada</strong></span>
				<span>{{ucfirst($selectedPlan->cycle())}}</span>
			</li>
		</ul>
		<div class="bg-teal text-white d-flex flex-wrap">
			<div class="p-3 flex-grow"><strong>INVESTIMENTO</strong></div>
			<div class="d-flex xs-w-100">
				<div class="p-3 bg-teal-dark flex-grow"><strong>{{feeTostring(fromCents($selectedPlan->fee))}}/{{$selectedPlan->cycle()}}</strong></div>
			</div>
		</div>
		<button id="submit" data-target="#form-credit" class="p-3 btn btn-red btn-block font-weight-bold">CONFIRMAR ASSINATURA</button>
	</div>
	<div class="px-2">
		<small>Ao finalizar o pagamento, você concorda com os <a class="link-default" href="#">Termos de uso</a>. Política de Privacidade © Metropolis Rio. Todos os direitos reservados.</small>
	</div>
</div>