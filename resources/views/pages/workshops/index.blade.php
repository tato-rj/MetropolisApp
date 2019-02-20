@extends('layouts.app')

@push('header')

@endpush

@section('content')

@include('pages.workshops.sections._lead')
@include('pages.workshops.sections.list')
@include('pages.welcome.sections.grid')
@include('pages.welcome.sections.partners')
@include('pages.welcome.sections.contact')

@endsection