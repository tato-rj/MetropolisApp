<section class="container mt-5 mb-7">
	<div class="row">
		<div class="col-default">
			<div>
				<p>Se preferir, pode enviar o seu contato por email para <a href="" class="link-blue">contato@metropolis.com.br</a>.</p>
			</div>
			<form method="POST" action="">
				{{csrf_field()}}
				<div class="form-group">
					<select class="form-control rounded-0">
						<option selected disabled>Tópico</option>
						<option>Agenda</option>
						<option>Pagamentos</option>
						<option>Eventos</option>
						<option>Software</option>
						<option>Outro</option>
					</select>
				</div>
				<div class="form-group">
					<input type="text" class="form-control rounded-0" name="subject" placeholder="Assunto">
				</div>
				<div class="form-group">
					<textarea class="form-control rounded-0" name="message" rows="8" placeholder="Escreva aqui a sua mensagem"></textarea>
				</div>
				<div class="text-center">
					<button type="submit" class=" btn btn-wide btn-red rounded-0"><strong>Envie a minha mensagem</strong></button>
				</div>
			</form>
		</div>

	</div>
</section>