@extends('admin.layouts.app')

@push('header')
<style type="text/css">
.fc-scroller {
	height: auto !important;
}
</style>
@endpush

@section('content')
	@include('admin.pages.dashboard.sections.intro')
	<div class="row">
		<div class="col-4">
			<div class="mb-4">
				@include('admin.components.calendar.numbers-today')
			</div>
			@include('admin.pages.dashboard.sections.calendar')
		</div>
		<div class="col-4">
			@include('admin.pages.dashboard.sections.workshop-ranking')
		</div>
		<div class="col-4">
			<div class="mb-4">
				@include('admin.pages.dashboard.sections.signups')
			</div>
			<div>
				@include('admin.pages.dashboard.sections.plans')
			</div>
		</div>
	</div>

	@include('components.modals.event')
	@include('components.modals.plan')
@endsection

@push('scripts')
<script type="text/javascript">
(new CustomCalendar('#calendar')).view('agendaDay').editable().create();
</script>
@endpush