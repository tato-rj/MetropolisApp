@extends('layouts.raw')

@section('content')
<div class="w-100 h-100vh d-flex justify-content-center align-items-center">
	<div class="text-center">
		<p>Bem vindo {{auth()->user()->name}}</p>
		<form method="POST" action="{{route('logout')}}">
			@csrf
			<button class="btn btn-red rounded-0">Sair</button>
		</form>
	</div>
</div>
@endsection