@extends('layouts.app')

@push('scripts')
<style type="text/css">
#terms-list ol { counter-reset: item; }
#terms-list li{ display: block }
#terms-list li:before { content: counters(item, ".") " "; counter-increment: item; }
#terms-list > ol > li:before { 
    font-weight: bold;
    background-color: #343a40;
    color: white;
    padding: 2px 6px 2px 18px;
    margin-right: 8px;
    border-bottom-right-radius: 16px;
    border-top-right-radius: 16px;
}
#terms-list > ol > li, #terms-list p {margin-bottom: 1.75em; color: #343a40}
#terms-list > ol > li > ol > li {margin-bottom: .5em; margin-top: .5em}
</style>
@endpush

@section('content')

@include('pages.terms.sections._lead')
@include('pages.terms.sections.list')

@endsection