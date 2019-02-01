@extends('layouts.app')

@section('content')

@include('pages.search.sections._lead')

<div class="container">
	<div class="row">
		<div class="col-default pb-6 pt-5">
			@include('pages.search.sections.confirm')
		</div>
	</div>
</div>

@include('pages.plans.show.sections.plans')
@include('pages.welcome.sections.partners')
@endsection

@push('scripts')

<script type="text/javascript">
(new CustomDatePicker('#datepicker')).enableSelect('select[name="space"]').create();

$('button[name="search"]').on('click', function() {
	$('form#search').submit();
});
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