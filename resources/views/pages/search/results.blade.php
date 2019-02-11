@if($report->status)
	@include('pages.search.success')
@else
	@include('pages.search.fail')
@endif
