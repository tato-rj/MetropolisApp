@extends('layouts.app')

@push('header')
<style type="text/css">
blockquote {
  display: block;
  border-width: 2px 0;
  border-style: solid;
  border-color: #eee;
  padding: 2em 0 1.15em;
  margin: 2.5em 2em;
  position: relative;
}
blockquote:before {
  content: '\201C';
  position: absolute;
  top: 0em;
  left: 50%;
  transform: translate(-50%, -50%);
  background: #fff;
  width: 3rem;
  height: 2rem;
  font: 6em/1.08em 'PT Sans', sans-serif;
  color: #666;
  text-align: center;
}
blockquote:after {
  content: "\2013 \2003" attr(cite);
  display: block;
  text-align: right;
  font-size: 0.875em;
  margin-top: 0.5em;
  color: #e74c3c;
}
</style>
@endpush

@section('content')

@include('pages.about.sections.main')
@include('pages.about.sections.highlight')
@include('pages.about.sections.description')
@include('pages.welcome.sections.grid')
@include('pages.welcome.sections.partners')
@include('pages.welcome.sections.contact')

@endsection