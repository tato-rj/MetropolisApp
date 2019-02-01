@extends('layouts.app')

@section('content')

@include('pages.workshops.show.sections._lead')
@include('pages.workshops.show.sections.description')
@include('pages.contact.sections.faq')

@endsection

@push('scripts')
<script type="text/javascript">
$('#review #date').text(
	moment(
		$('#review #date').attr('data-date')
	).locale('pt').format("D [de] MMMM [de] YYYY")
);
</script>
@endpush