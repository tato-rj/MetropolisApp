@extends('layouts.app')

@section('content')

@include('pages.plans.sections.main')
@include('pages.plans.sections.description')
@include('pages.plans.sections.plans')
@include('pages.contact.sections.faq')

@include('pages.plans.sections.modals.co-working')
@include('pages.plans.sections.modals.conference')

@endsection

@push('scripts')
<script type="text/javascript">

$('#modal-co-working .thumb, #modal-conference .thumb').on('mouseenter', function() {
	$thumb = $(this);
	$modal = $($thumb.attr('data-modal'));
	$image = $thumb.css('background-image');

	$modal.find('.thumb').addClass('hover-grayscale-out');
	$thumb.removeClass('hover-grayscale-out');
	$modal.find('.cover').css('background-image', $image);
});

$('#modal-co-working, #modal-conference').on('show.bs.modal', function (e) {
	let $button = $(e.relatedTarget);
	let $modal = $(e.target);
	
	$modal.find('.price').text($button.attr('data-price'));
	$modal.find('.duration').text($button.attr('data-duration-string'));

	$modal.find('input[name="duration"]').val($button.attr('data-duration'));
})
</script>
@endpush