@extends('layouts.app')

@section('content')

@include('pages.user.profile.sections._lead')
@include('pages.user.profile.sections.fields')
@include('pages.welcome.sections.contact')

@endsection

@push('scripts')
@endpush