@component('layouts.header.partial', ['background' => 'images/workstation.jpg'])
	<div class="container text-white">
		<div class="row">
			<div class="col-default">
				<h1 class="display-4">Suporte ao cliente</h1>
				<p class="lead">Estamos aqui para atender a qualquer dúvida, pergunta ou sugestão. Deixe abaixo a sua mensagem e retornaremos o mais rápido possível.</p>
			</div>
		</div>
	</div>
@endcomponent

@include('components.alerts.plan')