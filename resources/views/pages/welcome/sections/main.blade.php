@component('layouts.header.full', ['background' => 'co-working'])
	<div class="container text-white z-10 mb-4 d-none d-sm-block">
		<div class="row">
			<div class="col-10 mx-auto">
				<h1 class="display-4">Colaboração. Produtividade.</h1>
				<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
			</div>
		</div>
	</div>
	<div class="container text-white z-10">
		@include('components.calendar.finder')
	</div>
@endcomponent