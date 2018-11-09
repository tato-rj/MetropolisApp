    <div class="row">
      @component('components.plans.card', ['title' => 'DIÁRIO', 'plan' => $basicPlans->find(1)->id, 'price' => fromCents($basicPlans->find(1)->fee), 'period' => 'dia', 'color' => 'indigo'])
        <p><i class="fas fa-door-open fa-fw mr-3 opacity-8"></i>Co-working ilimitado</p>
        <p><i class="fas fa-wifi fa-fw mr-3 opacity-8"></i>Wifi de alta velocidade</p>
        <p><i class="fas fa-coffee mr-3 opacity-8"></i>Café, chá e água à vontade</p>
        <p><i class="fas fa-briefcase fa-fw mr-3 opacity-8"></i>Sala Tóquio por 40 min/dia</p>
      @endcomponent

      @component('components.plans.card', ['title' => 'SEMANAL', 'plan' => $basicPlans->find(2)->id, 'price' => fromCents($basicPlans->find(2)->fee), 'period' => 'semana', 'color' => 'orange'])
        <p><i class="fas fa-door-open fa-fw mr-3 opacity-8"></i>Co-working ilimitado</p>
        <p><i class="fas fa-wifi fa-fw mr-3 opacity-8"></i>Wifi de alta velocidade</p>
        <p><i class="fas fa-coffee mr-3 opacity-8"></i>Café, chá e água à vontade</p>
        <p><i class="fas fa-briefcase fa-fw mr-3 opacity-8"></i>Sala Tóquio por 3 h/semana</p>
      @endcomponent

      @component('components.plans.card', ['title' => 'MENSAL', 'plan' => $basicPlans->find(3)->id, 'price' => fromCents($basicPlans->find(3)->fee), 'period' => 'mês', 'color' => 'green'])
        <p><i class="fas fa-door-open fa-fw mr-3 opacity-8"></i>Co-working ilimitado</p>
        <p><i class="fas fa-wifi fa-fw mr-3 opacity-8"></i>Wifi de alta velocidade</p>
        <p><i class="fas fa-coffee mr-3 opacity-8"></i>Café, chá e água à vontade</p>
        <p><i class="fas fa-briefcase fa-fw mr-3 opacity-8"></i>Sala Tóquio por 8 h/mês</p>
      @endcomponent
    </div>