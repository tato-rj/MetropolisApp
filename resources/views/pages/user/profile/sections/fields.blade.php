<section class="mb-7 mt-6 container">
  <div class="row">
  	<div class="col-default">

      <div class="view-form mb-4">
        <div class="mb-2 pb-2 border-bottom align-items-center d-apart">
          <label class="m-0"><strong>DADOS PESSOAIS</strong></label>
          <span class="cursor-pointer text-red">editar</span>
        </div>

        @include('pages.user.profile.sections.show-field', [
          'label' => 'Nome completo',
          'value' => auth()->user()->name])

        @include('pages.user.profile.sections.show-field', [
          'label' => 'Email',
          'value' => auth()->user()->email])

      </div>

      <div class="view-form">
        <div class="mb-2 pb-2 border-bottom align-items-center d-apart">
          <label class="m-0"><strong>DADOS DE PAGAMENTO</strong></label>
          <span class="cursor-pointer text-red">editar</span>
        </div>

        <div class="text-center text-muted p-3"><i>O seu cartão não está salvo</i></div>
      </div>
  	</div>
  </div>
</section>