<div class="row mb-5 {{! $loop->last ? 'pb-5 border-bottom' : null}}">
	<div class="col-4">
		<img src="{{$workshop->cover_image}}" class="w-100 mb-3">
		<div class="mb-1"><strong class="text-teal">DATA</strong> {{$workshop->starts_at->format('d/m/Y')}}</div>
		<div><strong class="text-teal">HORÁRIO</strong> {{$workshop->starts_at->format('H:i')}} às {{$workshop->ends_at->format('H:i')}}</div>
	</div>
	<div class="col-8 d-apart flex-column">
		<div class="mb-2">
			@include('pages.workshops.sections.share')
			<h5 class="mb-2"><strong>{{$workshop->name}}</strong></h5>
			<div>{{$workshop->headline}}</div>
		</div>
		<div class="d-flex align-items-center justify-content-end">
			<a href="#" class="btn btn-teal"><strong><i class="fas fa-info-circle mr-2"></i>Mais informações</strong></a>
		</div>
	</div>
</div>