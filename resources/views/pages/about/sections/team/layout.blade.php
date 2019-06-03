<section class="container mb-8">
	<h3 class="text-center mb-6">Nossa equipe</h3>
	<div class="row">
		@component('pages.about.sections.team.member', [
			'image' => 'hilton', 'name' => 'Hilton Villasanti R. Jr', 'position' => 'legal',
			'fields' => ['PLANEJAMENTO DE NEGÓCIOS', 'CONSULTORIA DE NEGÓCIOS', 'CONTRATOS SOCIAIS', 'REGISTRO DE EMPRESAS', 'STARTUPS', 'EMPREENDEDORISMO', 'REGULARIZAÇÃO DE EMPRESAS', 'PROJETOS']])
		@slot('icons')
			<a href="" class="p-2 link-inherit"><i class="far fa-envelope"></i></a>
			<a href="" class="p-2 link-inherit"><i class="fab fa-linkedin-in"></i></a>
		@endslot
		@endcomponent

		@component('pages.about.sections.team.member', [
			'image' => 'joana', 'name' => 'Joana Araujo', 'position' => 'legal',
			'fields' => ['TERMOS E CONDIÇÕES', 'CONTRATOS', 'STARTUPS', 'DIREITO DIGITAL', 'DIREITO DA INTERNET', 'INTERNET DAS COISAS', 'MÍDIAS DIGITAIS', 'MARCAS']])
		@slot('icons')
			<a href="" class="p-2 link-inherit"><i class="far fa-envelope"></i></a>
			<a href="" class="p-2 link-inherit"><i class="fab fa-linkedin-in"></i></a>
			<a href="" class="p-2 link-inherit"><i class="fab fa-twitter"></i></a>
		@endslot
		@endcomponent

		@component('pages.about.sections.team.member', [
			'image' => 'larissa', 'name' => 'Larissa Pochmann', 'position' => 'legal',
			'fields' => ['COMPLIANCE', 'ANÁLISE DE RISCOS', 'PROTEÇÃO DE DADOS', 'REGULATÓRIO', 'DIREITO ECONÔMICO', 'ACORDO DE SÓCIOS', 'WORKSHOPS']])
		@slot('icons')
			<a href="" class="p-2 link-inherit"><i class="far fa-envelope"></i></a>
			<a href="" class="p-2 link-inherit"><i class="fab fa-facebook-f"></i></a>
		@endslot
		@endcomponent

		@component('pages.about.sections.team.member', [
			'image' => 'paulo', 'name' => 'Paulo Henrique Paiva', 'position' => 'financeiro',
			'fields' => ['INVESTIMENTOS', 'ANÁLISE ECONÔMICA', 'CRIPTOMOEDAS', 'CROWDFUNDING', 'ACESSO A CAPITAL', 'FINANCIAMENTOS', 'AQUISIÇÕES']])
		@slot('icons')
			<a href="" class="p-2 link-inherit"><i class="far fa-envelope"></i></a>
			<a href="" class="p-2 link-inherit"><i class="fab fa-linkedin-in"></i></a>
			<a href="" class="p-2 link-inherit"><i class="fab fa-facebook-f"></i></a>
		@endslot
		@endcomponent

		@component('pages.about.sections.team.member', [
			'image' => 'marco', 'name' => 'Marco Fernandes', 'position' => 'technologia',
			'fields' => ['SOTFTWARE', 'INOVAÇÃO', 'PROGRAMAÇÃO', 'ASSISTÊNCIA TÉCNICA', 'LOGÍSTICA']])
		@slot('icons')
			<a href="" class="p-2 link-inherit"><i class="far fa-envelope"></i></a>
			<a href="" class="p-2 link-inherit"><i class="fab fa-linkedin-in"></i></a>
			<a href="" class="p-2 link-inherit"><i class="fab fa-facebook-f"></i></a>
		@endslot
		@endcomponent

		@component('pages.about.sections.team.member', [
			'image' => 'arthur', 'name' => 'Arthur Villar', 'position' => 'technologia',
			'fields' => ['PROGRAMADOR FULLSTACK', 'WEBSITE', 'E-COMMERCE', 'IDENTIDADE VISUAL', 'BANCO DE DADOS', 'API','SUPORTE TÉCNICO']])
		@slot('icons')
			<a href="" class="p-2 link-inherit"><i class="far fa-envelope"></i></a>
			<a href="" class="p-2 link-inherit"><i class="fab fa-github"></i></a>
			<a href="" class="p-2 link-inherit"><i class="fab fa-facebook-f"></i></a>
		@endslot
		@endcomponent
	</div>
</section>