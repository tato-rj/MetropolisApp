@if($upcomingWorkshop)
<section class="mb-7 container">
  <div class="row">
  	<div class="col-4">
  		@include('admin.components.cards.workshop', ['workshop' => $upcomingWorkshop, 'note' => 'Próximo Workshop', 'editable' => false])
  	</div>
  	<div class="col-8 px-4">
  		<div class="mb-4 pb-4 border-bottom">
	  		<p class="mb-0 text-grey"><small>WORKSHOPS</small></p>
	  		<h3>Conheça os nossos workshops</h3>
	  		<p class="lead">Além de oferecer espaços de trabalho, nós organizamos workshops nas mais diversas profissões.</p>
	  		<p class="m-0">Magna aliqua. Ut enim ad minim veniam,
	  		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	  		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	  		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	  		proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <a href="{{route('workshops.index')}}" class="link-red">Veja os nossos worshops</a></p>
	  	</div>
		<p class="mb-0 text-grey"><small>PERGUNTA</small></p>
	  	<p class="lead">Eu posso usar o espaço do escritório para dar a minha própria paletra?</p>
	  	<p>Com certeza, o nosso escritório está aberto a todos os profissionais que desejam oferecer workshops/palestras. Para isso basta você entrar em contato conosco e marcar uma reunião para definirmos os detalhes e agendar o seu evento.</p>
  		<a href="{{route('contact')}}" class="btn btn-red"><i class="fas fa-lightbulb mr-2"></i>Quero criar um workshop</a>
  	</div>
  </div>
</section>
@endif