@extends('admin.layouts.app')

@section('content')

<div class="row mb-2">
	<div class="col-4">
		<img src="{{asset($workshop->cover_image_path)}}" class="w-100 mb-4">
		<h4>{{$workshop->name}}</h4>
		<div class="mb-1"><strong class="text-teal mr-2">DATA</strong>{{$workshop->starts_at->format('d/m/Y')}}</div>
		<div class="mb-2"><strong class="text-teal mr-2">HORÁRIO</strong>{{$workshop->starts_at->format('H:i')}} às {{$workshop->ends_at->format('H:i')}}</div>
		<p>{{$workshop->headline}}</p>
		<div>
			@include('components.workshops.files', ['removable' => false])
		</div>
	</div>
	<div class="col-8">
	  @if($workshop->attendees->isEmpty())
	  	<div class="py-4 text-muted text-center lead">Este workshop {{$workshop->hasPassed() ? 'não teve' : 'ainda não tem'}} nenhuma reserva</div>
	  @else
		<div class="table-responsive-lg">
			<table class="table table-hover table-bordered">
				<thead>
					<tr class="border-bottosm">
						<th style="width:15%">Data</th>
						<th style="width:22%">Nome</th>
						<th style="width:38%">Email</th>
						<th style="width:25%">Telefone</th>
					</tr>
				</thead>
				<tbody>
					@foreach($workshop->attendees as $attendee)
					
						<tr class="cursor-pointer user" data-url="{{route('admin.users.edit', $attendee->id)}}" title="Ver dados do usuário">
							<td style="width:15%">{{$attendee->pivot->created_at->format('d/m/Y')}}</td>
							<td style="width:22%">{{$attendee->name}}</td>
							<td style="width:38%">{{$attendee->email}}</td>
							<td style="width:25%">{{$attendee->phone}}</td>
						</tr>
					
					@endforeach
				</tbody>
			</table>
		</div>
  	@endif
	</div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
$('.user').on('click', function() {
	window.location.href = $(this).attr('data-url');
});
</script>
@endpush