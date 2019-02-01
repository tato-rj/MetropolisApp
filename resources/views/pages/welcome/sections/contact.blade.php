<section class="container-fluid py-8 bg-light">
	<div class="row">
		<div class="col-10 mx-auto text-center">
			<h3 class="mb-4">{{auth()->check() ? 'Tem alguma dúvida?' : 'Marque uma visita'}}</h3>
			<p class="lead mb-5">Envie uma mensagem para o nosso escritório e retornaremos o mais rápido possível.</p>
			<a href="/contato" class="btn btn-wide btn-red"><strong>Entre em contato conosco</strong></a>
		</div>
	</div>
</section>