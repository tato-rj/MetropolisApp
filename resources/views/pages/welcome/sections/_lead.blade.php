@component('layouts.header.full', ['background' => 'images/workstation'])
	<div class="container text-white z-10 mb-4">
		<div class="row">
			<div class="col-10 mx-auto">
				<h1 class="display-4">Colaboração. Produtividade.</h1>
				<p class="lead d-none d-sm-block">Oferecemos um espaço moderno de co-working, salas de reunião e workshops para você se aperfeiçoar ainda mais na sua área de trabalho.</p>
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