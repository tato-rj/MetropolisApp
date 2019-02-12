@extends('admin.layouts.app')

@push('header')
@endpush

@section('content')
	@include('admin.pages.schedule.sections.calendar')

  @include('components.modals.event')
  @include('components.modals.plan')
@endsection

@push('scripts')
<script type="text/javascript">
(new CustomCalendar('#calendar')).editable().creatable().create();
</script>
@endpush