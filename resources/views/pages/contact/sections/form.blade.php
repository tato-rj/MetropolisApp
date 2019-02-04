<section class="container mt-5 mb-7">
	<div class="row">
		<div class="col-default">
			<div class="row mb-4">
				<div class="col-6">
					O nosso escritório está aberto de Seg. à Sex. das 8 às 18 horas. Se entrar em contato conosco fora do horário de atendimento, a nossa equipe irá retornar o mais rápido possível.
				</div>
				<div class="col-6">
					<h3 class="mb-3">
						<a href="{{formatPhoneLink('whatsapp', '(21) 999-498-498')}}" class="mb-1 link-none"><i class="fab fa-whatsapp text-teal fa-lg mr-2"></i>(21) 999-498-498</a>
					</h3>
					<h3>
						<a href="{{formatPhoneLink('phone', '(21) 3199-1377')}}" class="m-0 link-none"><i class="fas fa-phone text-teal mr-2"></i>(21) 3199-1377</a>
					</h3>
				</div>
			</div>
			<div>
				<p>Se preferir, pode enviar o seu contato por email para <a href="" class="link-red">contato@metropolis.com.br</a>.</p>
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