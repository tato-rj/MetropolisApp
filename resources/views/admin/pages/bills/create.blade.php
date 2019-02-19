@extends('admin.layouts.app')

@section('content')
<div class="row">
	<div class="col-5">
		<div class="d-apart text-grey mb-4">
			<div>
				<h4><strong>Veja ao lado como este email vai ficar</strong></h4>
			</div>
			<div>
				<i class="fas fa-angle-right fa-3x"></i>
			</div>
		</div>
		<form method="POST" action="{{route('admin.bills.store')}}">
			@csrf

			@input(['bag' => 'default', 'name' => 'recipient_name', 'placeholder' => 'Nome do recipiente', 'classes' => 'to-preview'])

			@input(['bag' => 'default', 'type' => 'email', 'name' => 'recipient_email', 'placeholder' => 'Email de quem vai receber a cobrança'])

			@input(['bag' => 'default', 'name' => 'name', 'placeholder' => 'Nome dessa cobrança', 'classes' => 'to-preview'])
			
			@textarea(['bag' => 'default', 'name' => 'description', 'placeholder' => 'Escreva aqui uma curta descriçao', 'limit' => 255, 'classes' => 'to-preview'])
			
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text rounded-0">R$</span>
					</div>
					<input type="text" name="fee" class="form-control to-preview" placeholder="Preço" value="{{old('fee')}}">
					<div class="input-group-append">
						<span class="input-group-text rounded-0">,00</span>
					</div>
				</div>
				@include('components/form/error', ['bag' => 'default', 'field' => 'fee'])
			</div>

			<button type="submit" class="btn btn-red show-overlay">Criar nova cobrança</button>
		</form>
	</div>
	<div class="col-6 mx-auto">
		@include('admin.pages.bills.sections.preview')
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