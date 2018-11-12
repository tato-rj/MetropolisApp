@extends('layouts.app')

@section('content')

@include('pages.user.schedule.sections._lead')
@include('pages.user.schedule.sections.calendar')
@include('pages.welcome.sections.partners')
@include('pages.welcome.sections.contact')

@endsection

@push('scripts')
<script type="text/javascript">
(new CustomDatePicker('#datepicker')).enableTogglers('.toggle-finder', toggleBg = false).create();
</script>
@endpush