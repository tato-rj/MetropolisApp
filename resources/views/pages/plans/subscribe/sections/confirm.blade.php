<form method="POST" action="{{route('client.plan.subscribe')}}">
	@csrf
	<input type="hidden" name="user_id" value="{{auth()->user()->id}}">
	<input type="hidden" name="plan_id" value="{{request('id')}}">

	<div class="bg-light border-top border-teal-light border-1x mb-4">
		<ul class="list-flat p-4" id="review">
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Data de início</strong></span>
				<span>{{toFormattedDateStringPt(now())}}</span>
			</li>
			<li>
				<span class="text-teal mr-1"><strong>Renovação automática a cada</strong></span>
				<span>{{ucfirst($plan->cycle())}}</span>
			</li>
		</ul>
		<div class="bg-teal text-white d-flex flex-wrap">
			<div class="p-3 flex-grow"><strong>INVESTIMENTO</strong></div>
			<div class="d-flex xs-w-100">
				<div class="p-3 bg-teal-dark flex-grow"><strong>{{feeTostring(fromCents($plan->fee))}}/{{$plan->cycle()}}</strong></div>
				<button type="submit" class="btn btn-red h-100 px-4" title="Clique aqui para continuar"><i class="fas fa-lg fa-angle-right"></i></button>
			</div>
		</div>
	</div>
</form>