@extends('layouts.app')

@section('content')

@include('pages.about.sections.main')
@include('pages.about.sections.description')
@include('pages.welcome.sections.grid')
@include('pages.welcome.sections.partners')
@include('pages.welcome.sections.contact')

@endsection