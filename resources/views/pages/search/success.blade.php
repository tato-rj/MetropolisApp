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
$('input#coupon').on('keyup', function() {
	$('input[name="coupon"]').val($(this).val().toUpperCase());
});

$('button#validate-coupon').click(function(event) {
	event.preventDefault();
	let $button = $(this);
	let $coupon = $('input#coupon');
	$button.siblings('div').hide();
	
	if ($coupon.val()) {
		$.get($button.attr('data-url'), {name: $coupon.val()}, function(response) {
			$button.siblings('div.' + response.status + '-feedback').text(response.message).show();
		}).fail(function(response) {
			console.log(response);
			alert('Não foi possível validar este coupon agora.');
		});
	} else {
		alert('Você esqueceu de escrever o nome do coupon');
	}
});
</script>
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