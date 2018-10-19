@extends('layouts.app')

@section('content')

@include('pages.search.sections.main')

<div class="container">
	<div class="row">
		<div class="col-default pb-6 pt-5">
			<div class="mb-4">
				@if($status)
				@include('components.alerts.success', ['message' => 'O espaço que você solicitou está disponível!'])
				@else
				<h5>Nós precisamos de algumas informações a mais...</h5>
				@endif
			</div>
			@include('pages.search.steps.schedule')
		</div>
	</div>	
</div>

@endsection

@push('scripts')
<script type="text/javascript">
(new CustomDatePicker('#datepicker')).enableSelect('select[name="space"]').create();
$('#search select, #search input').on('change', function() {
	$('.form-group').removeClass('hover-grayscale-out');
	$('button[name="refresh"]').show();
	$('button[name="continue"]').hide();
});
$('button[name="refresh"], button[name="continue"]').on('click', function() {
	$('form#search').submit();
});
</script>
@endpush