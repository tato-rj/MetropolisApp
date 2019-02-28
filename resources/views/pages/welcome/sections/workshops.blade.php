<section class="mb-7 container">
  <div class="row">
  	<div class="col-8">
  		<div>
	  		<p class="mb-0 text-grey"><small>WORKSHOPS</small></p>
	  		<h3>Conheça os nossos workshops</h3>
	  		<p class="lead">Além de oferecer espaços de trabalho, nós organizamos workshops nas mais diversas profissões.</p>
	  		<p class="m-0">Os nossos workshops e paletras têm como objetivo a disseminação de tópicos fundamentais às diversas áreas de trabalho, bem como estimular a integração e intercâmbio de conhecimento entre profissionais especializados e os nossos membros. 
          <a href="{{route('workshops.index')}}" class="link-red">Veja os nossos worshops</a>
        </p>
	  	</div>
  	</div>
    <div class="col-4">
      <div class="border">
        <div class="alert-grey text-center px-3 py-2" style="color: #9aa9b7">Próximos eventos</div>
        @foreach($workshops as $workshop)
        <div class="px-3">
          <div class="py-2 {{! $loop->last ? 'border-bottom' : null}}">
            <div class="text-truncate font-weight-bold text-dark"><a class="link-inherit" href="{{route('workshops.show', $workshop->slug)}}">{{$workshop->name}}</a></div>
            <span class="text-muted">
              <small>dia {{$workshop->starts_at->format('d/m')}} às {{$workshop->starts_at->format('H')}} horas</small>
            </span>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>