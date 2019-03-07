<section class="container mb-8">
	<h3 class="text-center mb-6">Nossa equipe</h3>
	<div class="row">
		@component('pages.about.sections.team.member', [
			'image' => 'hilton', 'name' => 'Hilton Romero Jr', 'position' => 'administrativo',
			'fields' => ['PROPRIEDADE INTELECTUAL', 'CONTRATOS', 'LICITAÇÕES', 'REGISTRO DE EMPRESAS', 'REGULATÓRIO']])
		@slot('icons')
			<a href="" class="p-2 link-inherit"><i class="far fa-envelope"></i></a>
			<a href="" class="p-2 link-inherit"><i class="fab fa-linkedin-in"></i></a>
		@endslot
		@endcomponent

		@component('pages.about.sections.team.member', [
			'image' => 'joana', 'name' => 'Joana Araújo', 'position' => 'administrativo',
			'fields' => ['REGULATÓRIO', 'CONTRATOS', 'LICITAÇÕES', 'SOCIAL VENTURES', 'TERMOS E CONDIÇÕES']])
		@slot('icons')
			<a href="" class="p-2 link-inherit"><i class="far fa-envelope"></i></a>
			<a href="" class="p-2 link-inherit"><i class="fab fa-linkedin-in"></i></a>
			<a href="" class="p-2 link-inherit"><i class="fab fa-twitter"></i></a>
		@endslot
		@endcomponent

		@component('pages.about.sections.team.member', [
			'image' => 'marco', 'name' => 'Marco Fernandes', 'position' => 'technologia',
			'fields' => ['PROGRAMAÇÃO', 'ADMINISTRADOR DE REDE', 'AQUISIÇÕES', 'ASSISTÊNCIA TÉCNICA']])
		@slot('icons')
			<a href="" class="p-2 link-inherit"><i class="far fa-envelope"></i></a>
			<a href="" class="p-2 link-inherit"><i class="fab fa-linkedin-in"></i></a>
			<a href="" class="p-2 link-inherit"><i class="fab fa-facebook-f"></i></a>
		@endslot
		@endcomponent

		@component('pages.about.sections.team.member', [
			'image' => 'paulo', 'name' => 'Paulo Henrique Paiva', 'position' => 'financeiro',
			'fields' => ['ACESSO A CAPITAL', 'FINANCIAMENTOS', 'AQUISIÇÕES', 'REGISTRO DE EMPRESAS']])
		@slot('icons')
			<a href="" class="p-2 link-inherit"><i class="far fa-envelope"></i></a>
			<a href="" class="p-2 link-inherit"><i class="fab fa-linkedin-in"></i></a>
			<a href="" class="p-2 link-inherit"><i class="fab fa-facebook-f"></i></a>
		@endslot
		@endcomponent

		@component('pages.about.sections.team.member', [
			'image' => 'arthur', 'name' => 'Arthur Villar', 'position' => 'technologia',
			'fields' => ['PROGRAMADOR FULLSTACK', 'WEBSITE', 'IDENTIDADE VISUAL', 'BANCO DE DADOS', 'SUPORTE TÉCNICO']])
		@slot('icons')
			<a href="" class="p-2 link-inherit"><i class="far fa-envelope"></i></a>
			<a href="" class="p-2 link-inherit"><i class="fab fa-github"></i></a>
			<a href="" class="p-2 link-inherit"><i class="fab fa-facebook-f"></i></a>
		@endslot
		@endcomponent

		@component('pages.about.sections.team.member', [
			'image' => 'larissa', 'name' => 'Larissa Pochmann', 'position' => 'administrativo',
			'fields' => ['ADMINISTRAÇÃO DE EVENTOS', 'SUPORTE AO CLIENTE', 'PLANEJAMENTO E LOGÍSTICA']])
		@slot('icons')
			<a href="" class="p-2 link-inherit"><i class="far fa-envelope"></i></a>
			<a href="" class="p-2 link-inherit"><i class="fab fa-facebook-f"></i></a>
		@endslot
		@endcomponent
	</div>
</section>