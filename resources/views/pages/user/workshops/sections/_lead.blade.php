@component('layouts.header.partial', ['background' => 'images/workstation.jpg'])
	<div class="container text-white">
		<div class="row">
			<div class="col-default">
				<h1 class="display-4">Meus workshops</h1>
				<p class="lead">Abaixo está a lista dos workshops que você se cadastrou. Nas páginas desses eventos você pode fazer o download dos materiais disponíveis.</p>
			</div>
		</div>
	</div>
@endcomponent

@include('components.alerts.plan')