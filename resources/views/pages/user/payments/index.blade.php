@extends('layouts.app')

@section('content')

@include('pages.user.payments.sections._lead')
@include('pages.user.payments.sections.table')
@include('pages.welcome.sections.contact')

@endsection

@push('scripts')
@endpush