<section class="container mb-8">
	<h3 class="text-center mb-6">Nossa equipe</h3>
	<div class="row">
		@component('pages.about.sections.team.member', [
			'imgId' => 52, 'name' => 'Jorge Saraiva', 'position' => 'sócio fundador',
			'fields' => ['PROPRIEDADE INTELECTUAL', 'CONTRATOS', 'LICITAÇÕES', 'REGISTRO DE EMPRESAS', 'REGULATÓRIO']])
		@slot('icons')
			<a href="" class="p-2 link-inherit"><i class="far fa-envelope"></i></a>
			<a href="" class="p-2 link-inherit"><i class="fab fa-linkedin-in"></i></a>
		@endslot
		@endcomponent

		@component('pages.about.sections.team.member', [
			'imgId' => 48, 'name' => 'Maria Mendes', 'position' => 'sócia fundadora',
			'fields' => ['REGULATÓRIO', 'CONTRATOS', 'LICITAÇÕES', 'SOCIAL VENTURES', 'TERMOS E CONDIÇÕES']])
		@slot('icons')
			<a href="" class="p-2 link-inherit"><i class="far fa-envelope"></i></a>
			<a href="" class="p-2 link-inherit"><i class="fab fa-linkedin-in"></i></a>
			<a href="" class="p-2 link-inherit"><i class="fab fa-twitter"></i></a>
		@endslot
		@endcomponent

		@component('pages.about.sections.team.member', [
			'imgId' => 11, 'name' => 'Jorge Marcondes', 'position' => 'sócio fundador',
			'fields' => ['WEB DEVELOPMENT', 'BANCO DE DADOS', 'IDENTIDADE VISUAL', 'MARCA', 'TECHNOLOGIA']])
		@slot('icons')
			<a href="" class="p-2 link-inherit"><i class="far fa-envelope"></i></a>
			<a href="" class="p-2 link-inherit"><i class="fab fa-linkedin-in"></i></a>
			<a href="" class="p-2 link-inherit"><i class="fab fa-github"></i></a>
		@endslot
		@endcomponent

		@component('pages.about.sections.team.member', [
			'imgId' => 18, 'name' => 'Marcos Medeiros', 'position' => 'financeiro',
			'fields' => ['ACESSO A CAPITAL', 'FINANCIAMENTOS', 'AQUISIÇÕES', 'REGISTRO DE EMPRESAS', 'CONTRATO SOCIAL']])
		@slot('icons')
			<a href="" class="p-2 link-inherit"><i class="far fa-envelope"></i></a>
			<a href="" class="p-2 link-inherit"><i class="fab fa-linkedin-in"></i></a>
			<a href="" class="p-2 link-inherit"><i class="fab fa-facebook-f"></i></a>
		@endslot
		@endcomponent

		@component('pages.about.sections.team.member', [
			'imgId' => 9, 'name' => 'Juliana Dutra', 'position' => 'office manager',
			'fields' => ['ATENTIMENTO AO CLIENTE', 'AGENDA', 'AQUISIÇÕES', 'COMMUNITY MANAGEMENT']])
		@slot('icons')
			<a href="" class="p-2 link-inherit"><i class="far fa-envelope"></i></a>
			<a href="" class="p-2 link-inherit"><i class="fab fa-facebook-f"></i></a>
		@endslot
		@endcomponent
	</div>
</section>