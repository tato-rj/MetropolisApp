<li><strong>{{$title}}</strong>
	@if(!empty($html))
	{!! $html !!}
	@else
	<ol>
		@foreach($items as $item)
		<li>{!! $item !!}</li>
		@endforeach
	</ol>
	@endif
</li>