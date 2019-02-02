<section class="mb-7 mt-6 container">
  <div class="row">
  	<div class="col-default">

      <div class="view-form mb-5">
        <div class="mb-2 pb-2 border-bottom align-items-center d-apart">
          <label class="m-0"><strong>DADOS PESSOAIS</strong></label>
          <span class="cursor-pointer text-red edit-field" data-target=".profile-fields">editar</span>
        </div>

        <div class="profile-fields" style="display: none;">
          <form method="POST" action="{{route('client.profile.update', auth()->user()->id)}}">
              @csrf
              <div class="form-group">
                <label class="mb-1"><small>Nome completo</small></label>
                <input type="text" name="name" class="form-control" value="{{auth()->user()->name}}" required>
              </div>
              <div class="form-group">
                <label class="mb-1"><small>Email</small></label>
                <input type="text" name="email" class="form-control" value="{{auth()->user()->email}}" required>
              </div>

              <button type="submit" class="btn btn-red mt-1">Atualizar</button>
          </form>
        </div>

        <div class="profile-fields">
          @include('pages.user.profile.sections.show-field', [
            'label' => 'Nome completo',
            'value' => auth()->user()->name,
            'field' => 'name'])

          @include('pages.user.profile.sections.show-field', [
            'label' => 'Email',
            'value' => auth()->user()->email,
            'field' => 'email'])
        </div>

      </div>

      <div class="view-form">
        <div class="mb-2 pb-2 border-bottom align-items-center d-apart">
          <label class="m-0"><strong>DADOS DE PAGAMENTO</strong></label>
          <span class="cursor-pointer text-red edit-field" data-target=".payment-fields">editar</span>
        </div>

        <div class="payment-fields" style="display: none;">
          <form method="POST" action="{{route('client.profile.update', auth()->user()->id)}}">
              @csrf

              @include('components.form.payment.credit-card')

              <button type="submit" class="btn btn-red mt-1">Atualizar</button>
          </form>
        </div>

        <div class="payment-fields">
          <div class="text-center text-muted p-3"><i>O seu cartão não está salvo</i></div>
        </div>

      </div>
  	</div>
  </div>
</section>