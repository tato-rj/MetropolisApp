@extends('errors::layout')

@section('code', 429)

@section('message', 'Você está fazendo muitos pedidos, mantenha a calma.')

@section('action')
<a href="{{route('welcome')}}" class="btn btn-red">Voltar para página principal</a>
@endsection