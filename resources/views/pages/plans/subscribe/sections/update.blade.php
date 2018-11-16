<div class="border-top pt-3 text-center">
	<div class="mb-2">Você já possui a assinatura do</div>
	<h4 class="mb-4"><strong class="text-{{auth()->user()->membership->plan->color}} text-uppercase">{{auth()->user()->membership->plan->displayName}}</strong></h4>
	<a href="#" class="btn btn-red"><strong>Quero modificar o meu plano</strong></a></p>
</div>