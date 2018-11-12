		<ul class="list-flat px-3 py-2">
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Espaço</strong></span>
				<span>Worksation</span>
			</li>
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Data</strong></span>
				<span id="date">12 de Novembro de 2018</span>
			</li>
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Hora de chegada</strong></span>
				<span>10:00 horas</span>
			</li>
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Duração</strong></span>
				<span class="mr-1">2 horas</span>
				<span class="text-muted text-italic"><small>(o escritório fecha às <u>{{durationToString(office()->day_ends_at)}}</u>)</small></span>
			</li>
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Número de participantes</strong></span>
				<span>4 {{trans_choice('words.pessoas', 4)}}</span>
			</li>
			<li>
				<span class="text-teal mr-1"><strong>Status</strong></span>
				<span class="text-green">Confirmado</span>
			</li>
		</ul>