@extends('admin.layouts.app')

@section('content')
@include('admin.pages.workshops.sections.list')
@include('admin.components.buttons.create', ['url' => route('admin.workshops.create')])
@endsection