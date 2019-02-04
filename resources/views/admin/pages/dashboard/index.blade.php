@extends('admin.layouts.app')

@section('content')

<div class="row mb-4">
	<div class="col-md-6">
		<h3 class="text-dark mb-4">Área administrativa do Metropolis Rio</h3>
		<p>Esta área é dedicada ao gerenciamento do conteúdo do site: agenda de eventos, workshops, assinaturas de planos e usuários. Aqui é possível criar, editar e remover qualquer evento ou workshop, além de acessar os dados dos assinantes e pagamentos.</p>
		<p>Veja abaixo algumas informações úteis sobre as atividades mais recentes.</p>
	</div>
	<div class="col-md-6">
		<div class="text-right">{{fullDatePt()}}</div>
	</div>
</div>

<div data-columns>

    @include('admin.pages.dashboard.sections.workshop-next')

    @include('admin.pages.dashboard.sections.workshop-ranking')
    
    @include('admin.pages.dashboard.sections.signups')

    @include('admin.pages.dashboard.sections.plans')

</div>

@endsection