@extends('layouts.app')

@section('content')

@include('pages.contact.sections._lead')
@include('pages.contact.sections.form')
@include('pages.contact.sections.faq')

@endsection

@push('scripts')
<script type="text/javascript">
$('input.phone-field').inputmask("(99) 9999-9999");
</script>
@endpush