<section class="container-fluid pb-8" style="background-image: url({{asset('images/misc/cityline.png')}});
    background-position: bottom;
    background-repeat: no-repeat;">
	<div class="row">
		<div class="col-10 mx-auto text-center">
			<h3 class="mb-4">{{auth()->check() ? 'Tem alguma dúvida?' : 'Marque uma visita'}}</h3>
			<p class="lead mb-5">Envie uma mensagem para o nosso escritório e retornaremos o mais rápido possível.</p>
			<a href="/contato" class="btn btn-wide btn-outline-dark">Entre em contato conosco</a>
		</div>
	</div>
</section>