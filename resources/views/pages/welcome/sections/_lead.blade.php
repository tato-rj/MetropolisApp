@component('layouts.header.full', ['background' => 'workstation'])
	<div class="container text-white z-10 mb-4">
		<div class="row">
			<div class="col-10 mx-auto">
				<h1 class="display-4">Colaboração. Produtividade.</h1>
				<p class="lead d-none d-sm-block">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
			</div>
		</div>
	</div>
	<div class="container text-white z-10 intro">
		@include('components.calendar.finder')
	</div>
@endcomponent
<div style="display: none;">
	<img src="{{asset("images/covers/workstation.jpg")}}">
	<img src="{{asset("images/covers/toquio.jpg")}}">
	<img src="{{asset("images/covers/vale-do-silicio.jpg")}}">
</div>