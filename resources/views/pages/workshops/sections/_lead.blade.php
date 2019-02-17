@component('layouts.header.partial', ['background' => 'images/workstation.jpg'])
	<div class="container text-white">
		<div class="row">
			<div class="col-default">
				<h1 class="display-4">Workshops</h1>
				<p class="lead">Oferecemos palestras nas as mais diversas áreas. Fique ligado na nossa agenda para não perder nenhum evento!</p>
				<p class="lead">Deseja organizar o seu próprio evento? Agora é muito fácil!</p>
				<a href="{{route('contact')}}" class="btn btn-red">Envie-nos a sua proposta</a>
			</div>
		</div>
	</div>
@endcomponent