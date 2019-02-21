@component('layouts.header.full', ['background' => 'images/workstation'])
	<div class="container text-white z-10">
		<div class="row">
			<div class="col-default">
				<h1 class="display-4">{{greeting()}} {{auth()->user()->first_name}}!</h1>
				<p class="lead d-none d-sm-block">Aqui você pode gerenciar a sua agenda, perfil, pagamentos e suporte técnico.</p>
				<div class="row">
					@include('pages.user.home.sections.button', [
						'title' => 'AGENDA', 'icon' => 'calendar-alt', 'url' => route('client.events.index')])
					@include('pages.user.home.sections.button', [
						'title' => 'WORKSHOPS', 'icon' => 'chalkboard-teacher', 'url' => route('client.workshops.index')])
					@include('pages.user.home.sections.button', [
						'title' => 'CADASTRO', 'icon' => 'address-card', 'url' => route('client.profile.show')])
					@include('pages.user.home.sections.button', [
						'title' => 'PAGAMENTOS', 'icon' => 'credit-card', 'url' => route('client.payments.index')])
				</div>
			</div>
		</div>
	</div>
@endcomponent