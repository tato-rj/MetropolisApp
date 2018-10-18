@component('pages.plans.sections.modals.layout', ['title' => 'Sala de reunião', 'type' => 'conference', 'count' => 8])
  <div class="alert-teal alert-accent-left alert mb-3">
    <div class="d-flex justify-content-between border-bottom mb-2 pb-2">
      <div class="text-muted"><strong>Duração</strong></div>
      <div class="duration font-weight-bold"></div>
    </div>
    <div class="d-flex justify-content-between">
      <div class="text-muted"><strong>Preço</strong></div>
      <div><span class="price font-weight-bold"></span></div>
    </div>
  </div>
  <div class="icons mb-3">
    @include('pages/plans/sections/icons', [
      'items' => [
        'Espaço para até 6 pessoas' => 'users',
        'Acesso privado' => 'door-closed',
        'Café, chá e água' => 'coffee',
        'Internet de alta velocidade' => 'wifi',
        'Segunda à sexta' => 'calendar-alt',
        '9h às 18h' => 'clock',
      ]
    ])
  </div>
  <div>
    <p><small>Enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit.</small></p>
  </div>
@endcomponent
