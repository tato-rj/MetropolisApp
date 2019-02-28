@extends('errors::layout')

@section('code', 429)

@section('message', 'O nosso servidor está com dificuldades. Se esse problema continuar, por favor nos avise!')

@section('action')
<a href="{{route('welcome')}}" class="btn btn-red">Voltar para página principal</a>
@endsection