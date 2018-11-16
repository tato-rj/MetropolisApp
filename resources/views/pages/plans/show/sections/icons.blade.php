@foreach($items as $name => $icon)
	<div class="mb-1">
		<small><i class="fas fa-{{$icon}} text-teal mr-2"></i>{{$name}}</small>
	</div>
@endforeach