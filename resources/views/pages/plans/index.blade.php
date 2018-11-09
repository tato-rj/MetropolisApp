@extends('layouts.app')

@push('header')
<style type="text/css">
.modal-dialog {
  width: 100%;
  max-width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
}

</style>
@endpush

@section('content')

@include('pages.plans.sections._lead')
@include('pages.plans.sections.description')
@include('pages.plans.sections.plans')
@include('pages.contact.sections.faq')

@include('components.calendar.modal')

@endsection

@push('scripts')
<script type="text/javascript">

(new CustomDatePicker('#datepicker')).enableTogglers('.toggle-finder', toggleBg = false).create();

$('.description button').on('click', function() {
	type = $(this).attr('data-type');

	$('#search-modal .toggle-finder[data-target="'+type+'"]').trigger('click');
});

$('#modal-workstation .thumb, #modal-conference .thumb').on('mouseenter', function() {
	$thumb = $(this);
	$modal = $($thumb.attr('data-modal'));
	$image = $thumb.css('background-image');

	$modal.find('.thumb').addClass('hover-grayscale-out');
	$thumb.removeClass('hover-grayscale-out');
	$modal.find('.cover').css('background-image', $image);
});

$('#modal-workstation, #modal-conference').on('show.bs.modal', function (e) {
	let $button = $(e.relatedTarget);
	let $modal = $(e.target);
	
	$modal.find('.price').text($button.attr('data-price'));
	$modal.find('.duration').text($button.attr('data-duration-string'));

	$modal.find('input[name="duration"]').val($button.attr('data-duration'));
})
</script>
@endpush