@component('layouts.header.partial', ['background' => 'workstation'])
	<div class="container text-white z-10 mb-5">
		<div class="row">
			<div class="col-default">
				<h1 class="display-4">Minha agenda</h1>
				<p class="lead">Faça uma nova busca ou veja os seus eventos agendados no calendário abaixo.</p>
			</div>
		</div>
	</div>
	<div class="container text-white z-10 intro">
		@include('components.calendar.finder')
	</div>
@endcomponent