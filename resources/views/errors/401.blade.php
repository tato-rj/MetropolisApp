@extends('errors::layout')

@section('code', 401)

@section('message', 'Você não tem autorização para acessar nessa página, tem certeza de que queria estar aqui?')

@section('action')
<a href="{{route('welcome')}}" class="btn btn-red">Voltar para página principal</a>
@endsection