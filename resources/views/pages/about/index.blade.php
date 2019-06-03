@extends('layouts.app')

@section('content')

@include('pages.about.sections._lead')
@include('pages.about.sections.highlight')
{{-- @include('pages.about.sections.description') --}}
@include('pages.about.sections.team.layout')
@include('pages.welcome.sections.grid')
@include('pages.welcome.sections.partners')
@include('pages.welcome.sections.contact')

@endsection