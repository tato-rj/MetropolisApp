@extends('admin.layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<p class="mb-4">Nós encontramos <strong>{{$pendingBills->count()}} {{ str_plural('cobrança', $pendingBills->count()) }}</strong> pendentes.</p>
		<div class="card-columns">
			@foreach($pendingBills as $bill)
			<div class="card alert-warning">
				<div class="card-body">
					<h5 class="card-title mb-3 font-weight-bold"><i class="fas fa-receipt mr-2"></i>{{$bill->title}}</h5>
					<ul class="card-text list-flat">
						<li><small>Enviado para</small></li>
						<li class="font-weight-bold mb-2">{{$bill->name}}</li>
						<li><small>Email</small></li>
						<li class="font-weight-bold mb-2">{{$bill->email}}</li>
						<li><small>Descrição</small></li>
						<li class="font-weight-bold mb-2">{{$bill->description}}</li>
					</ul>
					<p class="card-text"><small class="">Criado no dia {{$bill->created_at->format('d/m/Y')}}</small></p>
				</div>
				<div class="card-footer">
					<form method="POST" action="{{route('admin.bills.store')}}">
						@csrf
						<input type="hidden" name="id" value="{{$bill->id}}">
						<input type="hidden" name="name" value="{{$bill->name}}">
						<input type="hidden" name="email" value="{{$bill->email}}">
						<input type="hidden" name="title" value="{{$bill->title}}">
						<input type="hidden" name="description" value="{{$bill->description}}">
						<input type="hidden" name="fee" value="{{$bill->fee}}">
						<button class="btn alert-warning font-weight-bold bg-transparent btn-block" title="Clique aqui para enviar esta cobrança por email novamente">Reenviar cobrança</button>
					</form>

				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
	$('.to-preview').on('keyup', function() {
		target = '#preview-' + $(this).attr('name');

		$(target).text($(this).val());
	});
</script>
@endpush