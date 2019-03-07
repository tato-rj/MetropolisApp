<div class="card alert-warning">
	<div class="card-body">
		<div class="d-apart mb-3">
			<h5 class="card-title mb-0 font-weight-bold"><i class="fas fa-receipt mr-2"></i>{{$bill->name}}</h5>
			<form method="POST" action="{{route('admin.bills.destroy', $bill->id)}}">
				@csrf
				@method('DELETE')
				<button type="submit" class="btn bg-transparent border-0 text-danger" title="Clique aqui para remover essa cobrança"><i class="fas fa-trash-alt"></i></button>
			</form>
		</div>
		<ul class="card-text list-flat">
			<li><small>Enviado para</small></li>
			<li class="font-weight-bold mb-2">{{$bill->recipient_name}}</li>
			<li><small>Email</small></li>
			<li class="font-weight-bold mb-2">{{$bill->recipient_email}}</li>
			<li><small>Descrição</small></li>
			<li class="font-weight-bold mb-2">{{$bill->description}}</li>
		</ul>
		<p class="card-text"><small class="">Criado no dia {{$bill->created_at->format('d/m/Y')}}</small></p>
	</div>
	<div class="card-footer">
		<form method="POST" action="{{route('admin.bills.store')}}">
			@csrf
			<input type="hidden" name="id" value="{{$bill->id}}">
			<input type="hidden" name="recipient_name" value="{{$bill->recipient_name}}">
			<input type="hidden" name="recipient_email" value="{{$bill->recipient_email}}">
			<input type="hidden" name="name" value="{{$bill->name}}">
			<input type="hidden" name="description" value="{{$bill->description}}">
			<input type="hidden" name="fee" value="{{$bill->fee}}">
			<button class="btn alert-warning font-weight-bold bg-transparent btn-block show-overlay" title="Clique aqui para enviar esta cobrança por email novamente">Reenviar cobrança</button>
		</form>

	</div>
</div>