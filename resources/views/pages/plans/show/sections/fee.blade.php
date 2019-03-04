<div class="flex-grow description text-right d-flex justify-content-center align-items-center flex-column">
	<h1 class="display-1 price" data-label="/hora">{{fromCents($space->fee)}}</h1>
	<div class="w-100 px-4">
		<button class="btn btn-teal btn-block" data-toggle="modal" data-type="{{$space->slug}}" data-target="#search-modal">Reserve agora</button>
	</div>
</div>