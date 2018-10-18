@foreach($items as $name => $item)
	<div class="d-flex {{! $loop->last ? 'border-bottom' : null}} px-2 pb-2 pt-0 mb-2">
		<div class="mr-auto"><strong>{{$item['duration']}}</strong></div>
		<div class="mr-3">R$ {{$item['price']}},00</div>
		<button class="btn btn-teal btn-xs rounded-0" 
			data-toggle="modal" data-target="#modal-{{$item['type']}}"
			data-price="R$ {{$item['price']}},00" data-duration="{{$item['duration']}}">Mais detalhes</button>
	</div>
@endforeach