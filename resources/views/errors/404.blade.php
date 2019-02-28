@extends('errors::layout')

@section('code', 404)

@section('message', 'Opa, não conseguimos encontrar esta página!')

@section('action')
<a href="{{route('welcome')}}" class="btn btn-red">Voltar para página principal</a>
@endsection