@component('layouts.header.partial', ['background' => 'images/workstation.jpg'])
	<div class="container text-white">
		<div class="row">
			<div class="col-default">
				<h1 class="display-4">Meus pagamentos</h1>
				<p class="lead">Encontre aqui todos os pagamentos online que você realizou conosco</p>
			</div>
		</div>
	</div>
@endcomponent

@include('components.alerts.plan')