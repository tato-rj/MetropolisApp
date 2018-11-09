<section class="container mb-8 mt-6">
	<div class="row plans mb-6">
		<div class="cover mb-4-sm">
			@include('pages.plans.sections.carousel.workstation')
		</div>
		<div class="col-lg-8 col-12 px-3">
			<div class="mb-4">
				<h3 class="mb-2">Workstation</h3>
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
					@include('pages.plans.sections.fee', ['space' => $spaces->find(1)])
				</div>
			</div>		
		</div>
	</div>

	<div class="row plans mb-6">
		<div class="cover mb-4-sm">
			@include('pages.plans.sections.carousel.toquio')
		</div>
		<div class="col-lg-8 col-12 px-3">
			<div class="mb-4">
				<h3 class="mb-2">Salas de reunião "Tóquio"</h3>
				<p class="lead m-0">Veja os nossos planos para esta sala de reunião:</p>
			</div>
			<div>
				<div class="d-flex flex-wrap">
					<div class="icons">
						@include('pages/plans/sections/icons', [
							'items' => [
								'Espaço para até 4 pessoas' => 'users',
								'Acesso privado' => 'door-closed',
								'Café, chá e água' => 'coffee',
								'Internet de alta velocidade' => 'wifi',
								'Segunda à sexta' => 'calendar-alt',
								'9h às 18h' => 'clock',
							]
						])
					</div>
					@include('pages.plans.sections.fee', ['space' => $spaces->find(2)])
				</div>
			</div>		
		</div>
	</div>

	<div class="row plans mb-6">
		<div class="cover mb-4-sm">
			@include('pages.plans.sections.carousel.vale-do-silicio')
		</div>
		<div class="col-lg-8 col-12 px-3">
			<div class="mb-4">
				<h3 class="mb-2">Salas de reunião "Vale do Silício"</h3>
				<p class="lead m-0">Veja os nossos planos para esta sala de reunião:</p>
			</div>
			<div>
				<div class="d-flex flex-wrap">
					<div class="icons">
						@include('pages/plans/sections/icons', [
							'items' => [
								'Espaço para até 6 pessoas' => 'users',
								'Acesso privado' => 'door-closed',
								'Café, chá e água' => 'coffee',
								'TV e frigobar' => 'tv',
								'Internet de alta velocidade' => 'wifi',
								'Segunda à sexta' => 'calendar-alt',
								'9h às 18h' => 'clock',
							]
						])
					</div>
					@include('pages.plans.sections.fee', ['space' => $spaces->find(3)])
				</div>
			</div>		
		</div>
	</div>

</section>
