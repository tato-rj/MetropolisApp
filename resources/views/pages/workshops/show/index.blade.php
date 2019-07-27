@extends('layouts.app')

@push('header')
<meta name="twitter:card" value="{{$workshop->headline}}">
<meta property="og:title" content="Workshop: {{$workshop->name}}" />
<meta property="og:type" content="article" />
<meta property="og:url" content="{{route('workshops.show', $workshop->slug)}}" />
<meta property="og:image" content="{{asset($workshop->cover_image_path)}}" />
<meta property="og:description" content="{{$workshop->headline}}" />
@endpush

@section('content')

@include('pages.workshops.show.sections._lead')
@include('pages.workshops.show.sections.description')
@include('pages.contact.sections.faq')

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
@endpush