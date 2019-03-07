@extends('layouts.app')

@section('content')

@include('pages.welcome.sections._lead')
@include('pages.about.sections.highlight')
@include('pages.welcome.sections.steps')
@include('pages.welcome.sections.workshops')
@include('sections.workshop-question')
@include('pages.welcome.sections.icons')
@include('pages.welcome.sections.grid')
@include('pages.welcome.sections.partners')
@include('pages.welcome.sections.contact')
@include('components.overlays.app-load')

@endsection

@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
  $('#app-load-overlay').fadeOut('fast');
});
</script>
<script type="text/javascript">
(new CustomDatePicker('#datepicker')).enableTogglers('.toggle-finder').create();

$('#video, #play-button').on('click', function() {
    if ($('#video').get(0).paused) {
        $('#video').get(0).play();
    } else {
        $('#video').get(0).pause();
    }
    $('#play-button').toggle();
});
</script>
@endpush