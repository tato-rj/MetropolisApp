<div class="mb-6">
	<label class="text-muted"><strong>CRIAR UM NOVO COUPON</strong></label>
	<form method="POST" action="{{route('admin.coupons.store')}}">
		@csrf
		<div class="form-row">
			<div class="col">
				<input type="text" name="name" placeholder="Nome" required class="form-control text-uppercase">
			</div>
			<div class="col">
				<input type="number" name="discount" placeholder="Desconto (%)" required class="form-control">
			</div>
			<div class="col">
				<input type="number" name="limit" placeholder="Limite de uso" class="form-control">
			</div>
			<div class="col">
				<input type="text" name="expires_at" placeholder="Válido até (DD/MM/YYYY)" class="form-control">
			</div>
			<div class="col">
				<button type="submit" class="btn btn-teal">Criar novo</button>
			</div>
		</div>
	</form>
</div>