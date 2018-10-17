@extends('layouts.app')

@section('content')

@include('pages.welcome.sections.main')
@include('pages.welcome.sections.about')
@include('pages.welcome.sections.steps')
@include('pages.welcome.sections.icons')
@include('pages.welcome.sections.grid')
@include('pages.welcome.sections.partners')
@include('pages.welcome.sections.contact')

@endsection

@push('scripts')
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