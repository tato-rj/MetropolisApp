@extends('errors::layout')

@section('code', 419)

@section('message', 'Parece que a sua sessão expirou. Pode tentar novamente, ou contacte o nosso escritório se este problema persistir.')

@section('action')
<a href="{{route('welcome')}}" class="btn btn-red">Voltar para página principal</a>
@endsection