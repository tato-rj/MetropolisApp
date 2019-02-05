@extends('admin.layouts.app')

@section('content')
	@include('admin.pages.dashboard.sections.intro')
	<div class="row">
		<div class="col-4">
			@include('admin.pages.dashboard.sections.workshop-next')
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
@endsection