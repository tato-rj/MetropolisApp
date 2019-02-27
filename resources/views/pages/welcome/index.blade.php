@extends('layouts.app')

@section('content')

<div id="loading-overlay" class="d-flex align-items-center justify-content-center" style="background-color: #0b0d10; position: fixed; top: 0; left: 0; width: 100%; height: 100vh; z-index: 10000000000000">
</div>

@include('pages.welcome.sections._lead')
@include('pages.about.sections.highlight')
@include('pages.welcome.sections.steps')
@include('sections.workshop-question')
@include('pages.welcome.sections.icons')
@include('pages.welcome.sections.grid')
@include('pages.welcome.sections.partners')
@include('pages.welcome.sections.contact')

@endsection

@push('scripts')
<script type="text/javascript">
window.onload = function() {
    $('#loading-overlay').fadeOut(function() {
    	$(this).remove();
    });
};
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