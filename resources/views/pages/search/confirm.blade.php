@include('components.alerts.success', ['message' => 'O espaço que você solicitou está disponível!'])

<h5 class="my-4 text-center">Resumo do seu pedido</h5>

<div class="bg-light border-top border-teal-light border-1x mb-5">
	<ul class="list-flat p-4" id="review">
		<li class="mb-2">
			<span class="text-teal"><strong>Data</strong></span>
			<span id="date" data-date="{{request()->date}}"></span>
		</li>
		<li class="mb-2">
			<span class="text-teal"><strong>Espaço</strong></span>
			<span>{{pt(request()->space)}}</span>
		</li>
		<li class="mb-2">
			<span class="text-teal"><strong>Duração</strong></span>
			<span>{{request()->duration == config('office.day_length') ? 'Dia inteiro' : request()->duration.'h'}}</span>
		</li>
		<li class="mb-2">
			<span class="text-teal"><strong>Hora de chegada</strong></span>
			<span>{{request()->time}} horas</span>
		</li>
		<li>
			<span class="text-teal"><strong>Número de participantes</strong></span>
			<span>{{request()->participants}} {{trans_choice('words.pessoas', request()->participants)}}</span>
		</li>
	</ul>
	<div class="bg-teal text-white d-flex justify-content-between">
		<div class="p-3"><strong>INVESTIMENTO TOTAL</strong></div>
		<div class="p-3 bg-teal-dark"><strong>R$80</strong></div>
	</div>
</div>


@if(auth()->check())
{{-- PAY --}}
@else
<h5>Já possui um cadastro conosco?</h5>
<p class="m-0">Sim, faça o <a href="{{route('login')}}" class="link-red">login</a> para continuar</p>
<p class="m-0">Não, você precisa criar um <a href="{{route('register')}}" class="link-red">cadastro</a> para efetuar a reserva</p>
@endif