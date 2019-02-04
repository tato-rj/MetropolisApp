@extends('admin.layouts.app')

@section('content')

@include('admin.pages.dashboard.sections.graphs')

<div data-columns>

    @include('admin.pages.dashboard.sections.workshop')

    @include('admin.pages.dashboard.sections.workshop-ranking')
    
    @include('admin.pages.dashboard.sections.signups')

</div>

@endsection