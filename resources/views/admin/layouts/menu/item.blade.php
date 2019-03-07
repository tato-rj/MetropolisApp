<li class="nav-item mb-3 {{checkActive($routes, 'text-teal')}}">
	@if(!empty($icon))
	<span class="cursor-pointer nav-icon"><i class="fas fa-{{$icon}}"></i></span>
	@elseif(!empty($label))
	<a href="{{route('admin.' . $page)}}" class="link-none">
		{{$label}}
	</a>
	@endif
</li>