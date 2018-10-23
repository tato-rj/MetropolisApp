@extends('layouts.app')

@section('content')

@include('pages.user.home.sections._lead')
@include('pages.about.sections.highlight')
@include('pages.welcome.sections.steps')
@include('pages.welcome.sections.icons')
@include('pages.welcome.sections.grid')
@include('pages.welcome.sections.partners')
@include('pages.welcome.sections.contact')

@endsection

@push('scripts')

@endpush