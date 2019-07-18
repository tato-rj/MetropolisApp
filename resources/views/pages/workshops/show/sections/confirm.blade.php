<form method="GET" action="{{route('workshops.payment', $workshop->slug)}}">
	<div class="bg-light border-top border-teal-light border-1x mb-4">
		<ul class="list-flat p-4" id="review">
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Nome</strong></span>
				<span><strong>{{$workshop->name}}</strong></span>
			</li>
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Data</strong></span>
				<span class="date-pt" data-date="{{$workshop->starts_at}}"></span>
			</li>
			<li>
				<span class="text-teal mr-1"><strong>Horário</strong></span>
				<span>Das {{$workshop->starts_at->format('H:i')}} às {{$workshop->ends_at->format('H:i')}}</span>
			</li>
		</ul>
		<div class="bg-teal text-white d-flex flex-wrap">
			<div class="p-3 flex-grow"><strong>INVESTIMENTO</strong></div>
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
				<button type="submit" class="btn btn-red h-100 px-4" title="Clique aqui para continuar"><i class="fas fa-lg fa-angle-right"></i></button>
			</div>
		</div>
	</div>
</form>