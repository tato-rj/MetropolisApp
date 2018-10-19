@extends('layouts.app')

@section('content')

@include('pages.search.sections.main')

<div class="container mb-5">
	<div class="row">
		<div class="col-default pb-6 pt-5">
			<div class="mb-4">
				@if($errors->any() || empty($available) || ! $available)
					@include('pages.search.form')
				@else
					@include('pages.search.confirm')
				@endif
			</div>
		</div>
	</div>

    <div class="text-center mb-4">
      <h3 class="text-center mb-4">Planos especiais</h3>
      <p class="lead m-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor.</p>
    </div>
	@include('components.plans.all')
</div>

@endsection

@push('scripts')
<script type="text/javascript">
(new CustomDatePicker('#datepicker')).enableSelect('select[name="space"]').create();
$('button[name="search"]').on('click', function() {
	$('form#search').submit();
});

$('#review #date').text(
	moment(
		$('#review #date').attr('data-date')
	).locale('pt').format("D [de] MMMM [de] YYYY")
);
</script>
@endpush