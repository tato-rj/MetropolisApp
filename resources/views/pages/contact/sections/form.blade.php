<section class="py-4 mb-5 bg-light">
	<div class="container">
		<div class="row">
			<div class="col-default">
				<div class=" d-flex">
					<div class=" flex-grow">
						<div class="mb-3"><i class="fas fa-building fa-lg mr-3 text-muted"></i><strong>Av. Rio Branco, nº 185 Sala 1025 - Centro, Rio de Janeiro/RJ</strong></div>
						<div><i class="fab fa-whatsapp fa-lg mr-3 text-muted"></i><strong>+55 21 3199-1377 | +55 21 3429-1377</strong></div>
					</div>
					<div class=" d-flex">
			            <a class="link-teal t-2 ml-3" href="#"><i class="fab fa-facebook-f fa-lg"></i></a>
			            <a class="link-teal t-2 ml-3" href="#"><i class="fab fa-instagram fa-lg"></i></a>
			            <a class="link-teal t-2 ml-3" href="#"><i class="fab fa-twitter fa-lg"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="container mb-8">
	<div class="row">
		<div class="col-default">
			<div class="mb-5">
				<p class="lead">Estamos aqui para atender a qualquer dúvida, pergunta ou sugestão. Deixe abaixo a sua mensagem e retornaremos em breve.</p>
				<p>Se preferir, pode enviar o seu contato por email para <a href="" class="link-blue">contato@metropolis.com.br</a>.</p>
			</div>
			<form method="POST" action="">
				{{csrf_field()}}
				<div class="form-group">
					<input type="text" class="form-control rounded-0" name="name" aria-describedby="emailHelp" placeholder="Nome completo">
				</div>
				<div class="form-row form-group">
					<div class="col">
						<input type="email" class="form-control rounded-0" name="email" aria-describedby="emailHelp" placeholder="Email">
					</div>
					<div class="col">
						<input type="password" class="form-control rounded-0" name="phone" placeholder="Telefone (opcional)">
					</div>					
				</div>

				<div class="form-group">
					<input type="text" class="form-control rounded-0" name="subject" placeholder="Assunto">
				</div>
				<div class="form-group">
					<textarea class="form-control rounded-0" name="message" rows="4" placeholder="Escreva aqui a sua mensagem"></textarea>
				</div>
				<div class="text-center">
					<button type="submit" class=" btn btn-wide btn-red rounded-0"><strong>Envie a minha mensagem</strong></button>
				</div>
			</form>
		</div>

	</div>
</section>