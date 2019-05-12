@extends('layouts.app')

@section('content')

@include('pages.user.profile.sections._lead')
@include('pages.user.profile.sections.fields')
@include('pages.welcome.sections.contact')

@endsection

@push('scripts')
<script type="text/javascript">
$('input[name="phone"]').inputmask("(21) 99999-9999");
</script>
<script type="text/javascript">
$('.edit-field').on('click', function() {
	let $button = $(this);
	let fields = $button.attr('data-target');

	if ($button.text() == 'editar') {
		$button.text('cancelar');
	} else {
		$button.text('editar');
	}

	$(fields).toggle();
});
</script>
@endpush