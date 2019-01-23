<div class="position-fixed text-center alert-{{$status}} w-100 p-2" style="bottom: 0; left: 0; z-index: 5">
	@if($status == 'success')
	<p class="m-0">Você tem a Estação Compartilhada reservada até as <strong>14:00</strong> para 1 pessoa</p>
	@elseif($status == 'warning')
	<p class="m-0"><i class="fas fa-stopwatch mr-2"></i>A sua próxima reserva vai começar em menos de <strong>1 hora</strong></p>
	@elseif($status == 'danger')
	<p class="m-0">A sua reserva terminou às <strong>14:00</strong></p>
	@endif
</div>