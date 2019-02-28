@extends('errors::layout')

@section('code', 424)

@section('message', $exception->getMessage())

@section('action')
<a href="{{route('welcome')}}" class="btn btn-red">Voltar para página principal</a>
@endsection