    <div class="row">
      @component('components.plans.card', ['title' => 'DIÁRIO', 'plan' => $completePlans->find(4)->id, 'price' => fromCents($completePlans->find(4)->fee), 'period' => 'dia', 'color' => 'blue'])
        <p><i class="fas fa-door-open fa-fw mr-3 opacity-8"></i>Co-working ilimitado</p>
        <p><i class="fas fa-wifi fa-fw mr-3 opacity-8"></i>Wifi de alta velocidade</p>
        <p><i class="fas fa-print fa-fw mr-3 opacity-8"></i>Acesso ilimitado à impressora</p>
        <p><i class="fas fa-coffee mr-3 opacity-8"></i>Café, chá e água à vontade</p>
        <p><i class="fas fa-mail-bulk fa-fw mr-3 opacity-8"></i>Endereço comercial</p>
        <p><i class="fas fa-briefcase fa-fw mr-3 opacity-8"></i>Qualquer sala por 40 min/dia</p>
      @endcomponent

      @component('components.plans.card', ['title' => 'SEMANAL', 'plan' => $completePlans->find(5)->id, 'price' => fromCents($completePlans->find(5)->fee), 'period' => 'semana', 'color' => 'purple'])
        <p><i class="fas fa-door-open fa-fw mr-3 opacity-8"></i>Co-working ilimitado</p>
        <p><i class="fas fa-wifi fa-fw mr-3 opacity-8"></i>Wifi de alta velocidade</p>
        <p><i class="fas fa-print fa-fw mr-3 opacity-8"></i>Acesso ilimitado à impressora</p>
        <p><i class="fas fa-coffee mr-3 opacity-8"></i>Café, chá e água à vontade</p>
        <p><i class="fas fa-mail-bulk fa-fw mr-3 opacity-8"></i>Endereço comercial</p>
        <p><i class="fas fa-briefcase fa-fw mr-3 opacity-8"></i>Qualquer sala por 3 h/semana</p>
      @endcomponent

      @component('components.plans.card', ['title' => 'MENSAL', 'plan' => $completePlans->find(6)->id, 'price' => fromCents($completePlans->find(6)->fee), 'period' => 'mês', 'color' => 'red'])
        <p><i class="fas fa-door-open fa-fw mr-3 opacity-8"></i>Co-working ilimitado</p>
        <p><i class="fas fa-wifi fa-fw mr-3 opacity-8"></i>Wifi de alta velocidade</p>
        <p><i class="fas fa-print fa-fw mr-3 opacity-8"></i>Acesso ilimitado à impressora</p>
        <p><i class="fas fa-coffee mr-3 opacity-8"></i>Café, chá e água à vontade</p>
        <p><i class="fas fa-mail-bulk fa-fw mr-3 opacity-8"></i>Endereço comercial</p>
        <p><i class="fas fa-briefcase fa-fw mr-3 opacity-8"></i>Qualquer sala por 8 h/mês</p>
      @endcomponent
    </div>