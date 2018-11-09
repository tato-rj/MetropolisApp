@extends('layouts.app')

@section('content')

@include('pages.search.sections._lead')

<div class="container ">
	<div class="row">
		<div class="col-default pb-6 pt-5">
			@include('components.alerts.error', ['message' => 
				empty($response['participantsLeft']) ? 
					'Infelizmente o espaço que você procurou não está disponível nessa data.' : 
					'Temos apenas <strong>'.$response['participantsLeft'].'</strong> lugares disponíveis entre os horários que você procurou.'
			])
			<h5 class="my-4 text-center">Vamos tentar novamente!</h5>
			@include('pages.search.sections.form')
		</div>
	</div>
</div>

@include('pages.plans.sections.plans')
@include('pages.welcome.sections.partners')
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
<script type="text/javascript">
$('input[name="send_emails"]').on('click', function() {
  if ($(this).val() == 'true') {
    $('#emails').fadeIn();
  } else {
    $('#emails').hide();
  }
});
</script>
@endpush