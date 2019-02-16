@if($upcomingWorkshop)
<section class="mb-7 container">
  <div class="row">
  	<div class="col-4">
  		@include('admin.components.cards.workshop', ['workshop' => $upcomingWorkshop, 'note' => 'Próximo Workshop', 'editable' => false])
  	</div>
  	<div class="col-8 px-4">
  		<div class="mb-5">
	  		<p class="mb-1 text-grey"><small>WORKSHOPS</small></p>
	  		<h3 class="mb-4">Conheça os nossos workshops</h3>
	  		<p class="lead">Além de oferecer espaços de trabalho, nós organizamos workshops nas mais diversas profissões.</p>
	  		<p>Magna aliqua. Ut enim ad minim veniam,
	  		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	  		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	  		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	  		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	  	</div>
  		<a href="{{route('workshops.index')}}" class="btn btn-red">Ver todos</a>
  	</div>
  </div>
</section>
@endif