@component('layouts.header.partial', ['background' => 'images/workstation.jpg'])
	<div class="container text-white">
		<div class="row">
			<div class="col-default">
				<h1 class="display-4">Solicitar uma reserva</h1>
				<p class="lead">
					{{$report->status ? 
					'Leia atentamente as informações abaixo antes de prosseguir para a página de pagamento' : 
					'Ajuste a sua pesguisa modificando a data, horário e/ou tipo de espaço que deseja'}}
				</p>
			</div>
		</div>
	</div>
@endcomponent