@foreach(config("office.spaces.{$space}.prices") as $price)
	<div class="d-flex {{! $loop->last ? 'border-bottom' : null}} px-2 pb-2 pt-0 mb-2">
		<div class="mr-auto"><strong>{{durationToString($price['duration'])}}</strong></div>
		<div class="mr-3">{{feeToString($price['fee'])}}</div>
		<button class="btn btn-teal btn-xs rounded-0" 
			data-toggle="modal" data-target="#modal-{{$space}}"
			data-price="{{feeToString($price['fee'])}}"
			data-duration="{{$price['duration']}}" 
			data-duration-string="{{durationToString($price['duration'])}}">Mais detalhes</button>
	</div>
@endforeach