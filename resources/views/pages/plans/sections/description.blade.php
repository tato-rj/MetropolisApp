<section class="container mb-8 mt-6">
	<div class="row mb-5 plans">
		<div class="cover mb-4-sm">
			@include('pages.plans.sections.carousel.co-working')
		</div>
		<div class="col-lg-8 col-12 px-3">
			<div class="mb-4">
				<h3 class="mb-2">Mesas compartilhadas</h3>
				<p class="lead m-0">Veja os nossos planos para as estações de trabalho compartilhadas:</p>
			</div>
			<div>
				<div class="d-flex flex-wrap">
					<div class="icons">
						@include('pages/plans/sections/icons', [
							'items' => [
								'Estação compartilhada' => 'users',
								'Café, chá e água' => 'coffee',
								'Internet de alta velocidade' => 'wifi',
								'Segunda à sexta' => 'calendar-alt',
								'9h às 18h' => 'clock',
							]
						])
					</div>
					<div class="flex-grow description">
						@include('pages/plans/sections/list', ['space' => 'co-working'])
					</div>
				</div>
			</div>		
		</div>
	</div>

	<div class="row plans">
		<div class="cover mb-4-sm">
			@include('pages.plans.sections.carousel.conference')
		</div>
		<div class="col-lg-8 col-md-6 col-12 px-3">
			<div class="mb-4">
				<h3 class="mb-2">Salas de reunião</h3>
				<p class="lead m-0">Veja os nossos planos para as salas de conferência:</p>
			</div>
			<div>
				<div class="d-flex flex-wrap">
					<div class="icons">
						@include('pages/plans/sections/icons', [
							'items' => [
								'Espaço para até 6 pessoas' => 'users',
								'Acesso privado' => 'door-closed',
								'Café, chá e água' => 'coffee',
								'Internet de alta velocidade' => 'wifi',
								'Segunda à sexta' => 'calendar-alt',
								'9h às 18h' => 'clock',
							]
						])
					</div>
					<div class="flex-grow description">
						@include('pages/plans/sections/list', ['space' => 'conference'])
					</div>
				</div>
			</div>		
		</div>
	</div>
</section>
