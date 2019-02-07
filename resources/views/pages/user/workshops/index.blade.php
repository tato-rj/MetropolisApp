@extends('layouts.app')

@section('content')

@include('pages.user.workshops.sections._lead')
@include('pages.user.workshops.sections.list')
@include('pages.welcome.sections.grid')
@include('pages.welcome.sections.partners')
@include('pages.welcome.sections.contact')

@endsection