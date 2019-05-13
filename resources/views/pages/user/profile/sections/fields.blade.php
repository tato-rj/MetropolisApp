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
              <div class="form-group">
                <label class="mb-1"><small>Telefone</small></label>
                <input type="text" name="phone" class="form-control" value="{{auth()->user()->phone}}" required>
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

          @include('pages.user.profile.sections.show-field', [
            'label' => 'Telefone',
            'value' => auth()->user()->formatted_phone,
            'field' => 'phone'])
        </div>
      </div>

      <div class="view-form mb-5">
        <div class="mb-2 pb-2 border-bottom align-items-center d-apart">
          <label class="m-0"><strong>PASSWORD</strong></label>
          <span class="cursor-pointer text-red edit-field" data-target=".password-fields">editar</span>
        </div>

        <div class="password-fields" style="display: none;">
          <form method="POST" action="{{route('client.profile.update.password', auth()->user()->id)}}">
              @csrf
              <div class="form-group">
                <label class="mb-1"><small>Novo password</small></label>
                <input type="password" name="password" class="form-control" required>
              </div>
              <div class="form-group">
                <label class="mb-1"><small>Confirme o password</small></label>
                <input type="password" name="password_confirmation" class="form-control" required>
              </div>

              <button type="submit" class="btn btn-red mt-1">Atualizar</button>
          </form>
        </div>

        <div class="password-fields">
          @include('pages.user.profile.sections.show-field', [
            'label' => 'Password',
            'value' => '&bull;&bull;&bull;&bull;&bull;&bull;',
            'field' => 'password'])
        </div>
      </div>

      <div class="view-form">
        <div class="mb-2 pb-2 border-bottom align-items-center d-apart">
          <label class="m-0"><strong>DADOS DE PAGAMENTO</strong></label>
        </div>

        @if(auth()->user()->hasCard)
        <div class="alert alert-grey d-apart align-items-center">
          <div>
            @include('components.form.payment.card-preview')
          </div>
          <form method="POST" action="{{route('client.profile.remove.creditCard', auth()->user()->id)}}">
              @csrf
              <button type="submit" class="btn btn-red">Remover</button>
          </form>
        </div>
        @else
        <div class="payment-fields">
          <div class="text-center text-muted p-3"><i>Não existe nenhum cartão salvo nesse momento</i></div>
        </div>
        @endif
      </div>
  	</div>
  </div>
</section>