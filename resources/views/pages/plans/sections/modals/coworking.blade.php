@component('pages.plans.sections.modals.layout', ['title' => 'Mesa Compartilhada', 'type' => 'coworking', 'count' => 6])
  <div class="alert-teal alert-accent-left alert mb-3">
    <div class="d-flex justify-content-between border-bottom mb-2 pb-2">
      <div class="text-muted"><strong>Duração</strong></div>
      <div class="duration font-weight-bold"></div>
    </div>
    <div class="d-flex justify-content-between">
      <div class="text-muted"><strong>Preço</strong></div>
      <div><span class="price font-weight-bold"></span><small> / pessoa</small></div>
    </div>
  </div>
  <div class="icons mb-3">
    @include('pages/plans/sections/icons', [
      'items' => [
        'Estação compartilhada' => 'users',
        'Café, chá e água' => 'coffee',
        'Internet de alta velocidade' => 'wifi',
        'Segunda à sexta' => 'calendar-alt',
        '9h às 18h' => 'clock',
      ]
    ])
  </div>
  <div>
    <p><small>Ut enim ad minim veniam, duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur.</small></p>
  </div>
@endcomponent
