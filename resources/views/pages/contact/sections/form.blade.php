<section class="container mt-5 mb-7">
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