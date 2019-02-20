@extends('layouts.app')

@push('header')
<meta name="twitter:card" value="{{$workshop->headline}}">
<meta property="og:title" content="Workshop: {{$workshop->name}}" />
<meta property="og:type" content="article" />
<meta property="og:url" content="{{route('workshops.show', $workshop->slug)}}" />
<meta property="og:image" content="{{asset($workshop->cover_image_path)}}" />
<meta property="og:description" content="{{$workshop->headline}}" />
@endpush

@section('content')

@include('pages.workshops.show.sections._lead')
@include('pages.workshops.show.sections.description')
@include('pages.contact.sections.faq')

@endsection
