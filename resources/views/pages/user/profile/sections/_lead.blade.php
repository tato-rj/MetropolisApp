@component('layouts.header.partial', ['background' => 'images/workstation.jpg'])
	<div class="container text-white">
		<div class="row">
			<div class="col-default">
				<h1 class="display-4">Meu cadastro</h1>
				<p class="lead">Aqui você pode modificar os seus dados pessoais e informações de pagamento.</p>
			</div>
		</div>
	</div>
@endcomponent

@include('components.alerts.plan')