@if(! empty($value)) 
	{{$value->format('Y-m-d')}}
@elseif(request()->has('date')) 
	{{request()->date}}
@else 
	{{now()->format('Y-m-d')}}
@endif