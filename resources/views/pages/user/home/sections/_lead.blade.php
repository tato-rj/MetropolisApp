@component('layouts.header.full', ['background' => 'co-working'])
	<div class="container text-white z-10">
		<div class="row">
			<div class="col-default">
				<h1 class="display-4">{{greeting()}} {{auth()->user()->first_name}}!</h1>
				<div class="row">
					@include('pages.user.home.sections.button', ['title' => 'AGENDA', 'icon' => 'calendar-alt'])
					@include('pages.user.home.sections.button', ['title' => 'CADASTRO', 'icon' => 'user'])
					@include('pages.user.home.sections.button', ['title' => 'PAGAMENTOS', 'icon' => 'credit-card'])
					@include('pages.user.home.sections.button', ['title' => 'SUPORTE', 'icon' => 'comments'])
				</div>
			</div>
		</div>
	</div>
@endcomponent