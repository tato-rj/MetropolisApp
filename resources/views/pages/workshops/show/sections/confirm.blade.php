<form method="GET" action="{{route('workshops.payment', $workshop->slug)}}">
	<div class="bg-light border-top border-teal-light border-1x mb-4">
		<ul class="list-flat p-4" id="review">
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Nome</strong></span>
				<span><strong>{{$workshop->name}}</strong></span>
			</li>
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Data</strong></span>
				<span id="date" data-date="{{$workshop->starts_at}}"></span>
			</li>
			<li>
				<span class="text-teal mr-1"><strong>Horário</strong></span>
				<span>Das {{$workshop->starts_at->format('H')}} às {{$workshop->ends_at->format('H')}} horas</span>
			</li>
		</ul>
		<div class="bg-teal text-white d-flex flex-wrap">
			<div class="p-3 flex-grow"><strong>INVESTIMENTO</strong></div>
			<div class="d-flex xs-w-100">
				<div class="p-3 bg-teal-dark flex-grow"><strong>{{feeTostring($workshop->fee)}}</strong></div>
				<button type="submit" class="btn btn-red h-100 px-4" title="Clique aqui para continuar"><i class="fas fa-lg fa-angle-right"></i></button>
			</div>
		</div>
	</div>
</form>