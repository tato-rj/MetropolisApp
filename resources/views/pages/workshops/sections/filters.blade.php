<div class="d-apart align-items-center flex-wrap">
	<div class="d-none d-md-flex">
		@if(! $workshops->isEmpty())
		<p class="m-0 text-muted"><small>Mostrando {{$workshops->firstItem()}} - {{$workshops->lastItem()}} de {{$workshops->total()}} {{str_plural('workshops', $workshops->total())}}</small></p>
		@endif
	</div>
	<div class="filter-form">
		<form method="GET" action="{{\URL::current()}}">
			<div class="d-flex">
				<select class="form-control {{!empty($bg) ? 'bg-' . $bg : null}}" name="filtro" onchange="this.form.submit()" style="border-top: 0; border-bottom: 0; border-right: 0; width: auto">
					<option value="todos" {{request('filtro') == 'todos' ? 'selected' : null}}>Mostrar todos</option>
					<option value="semana" {{request('filtro') == 'semana' ? 'selected' : null}}>Nessa semana</option>
					<option value="mes" {{request('filtro') == 'mes' ? 'selected' : null}}>Nesse mês</option>
					<option value="gratuitos" {{request('filtro') == 'gratuitos' ? 'selected' : null}}>Gratuitos</option>
				</select>
				<select class="form-control {{!empty($bg) ? 'bg-' . $bg : null}}" name="ordem" onchange="this.form.submit()" style="border-top: 0; border-bottom: 0; width: auto">
					<option value="data_cresc" {{request('ordem') == 'data_cresc' ? 'selected' : null}}>Data: cresc.</option>
					<option value="data_decresc" {{request('ordem') == 'data_decresc' ? 'selected' : null}}>Data: decresc.</option>
					<option value="nome_cresc" {{request('ordem') == 'nome_cresc' ? 'selected' : null}}>Nome: A - Z</option>
					<option value="nome_decresc" {{request('ordem') == 'nome_decresc' ? 'selected' : null}}>Nome: Z - A</option>
				</select>
			</div>
		</form>
	</div>
</div>