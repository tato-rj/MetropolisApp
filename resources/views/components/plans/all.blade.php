    <div class="row">
      @component('components.plans.card', ['title' => 'MENSAL', 'price' => office()->monthly($discount = 30), 'discount' => 30, 'color' => 'indigo'])
        <p><i class="fas fa-door-open fa-fw mr-3 opacity-8"></i>Co-working ilimitado</p>
        <p><i class="fas fa-wifi fa-fw mr-3 opacity-8"></i>Wifi de alta velocidade</p>
        <p><i class="fas fa-print fa-fw mr-3 opacity-8"></i>Acesso ilimitado à impressora</p>
        <p><i class="fas fa-coffee mr-3 opacity-8"></i>Café, chá e água à vontade</p>
        <p><i class="fas fa-piggy-bank mr-3 opacity-8"></i>Descontos exclusivos</p>
      @endcomponent

      @component('components.plans.card', ['title' => 'SEMESTRAL', 'price' => office()->monthly($discount = 35), 'discount' => 35, 'color' => 'orange'])
        <p><i class="fas fa-door-open fa-fw mr-3 opacity-8"></i>Co-working ilimitado</p>
        <p><i class="fas fa-wifi fa-fw mr-3 opacity-8"></i>Wifi de alta velocidade</p>
        <p><i class="fas fa-print fa-fw mr-3 opacity-8"></i>Acesso ilimitado à impressora</p>
        <p><i class="fas fa-coffee mr-3 opacity-8"></i>Café, chá e água à vontade</p>
        <p><i class="fas fa-piggy-bank mr-3 opacity-8"></i>Descontos exclusivos</p>
        <p><i class="fas fa-briefcase fa-fw mr-3 opacity-8"></i>Sala de reunião por 2 h/mês</p>
      @endcomponent

      @component('components.plans.card', ['title' => 'ANUAL', 'price' => office()->monthly($discount = 40), 'discount' => 40, 'color' => 'green'])
        <p><i class="fas fa-door-open fa-fw mr-3 opacity-8"></i>Co-working ilimitado</p>
        <p><i class="fas fa-wifi fa-fw mr-3 opacity-8"></i>Wifi de alta velocidade</p>
        <p><i class="fas fa-print fa-fw mr-3 opacity-8"></i>Acesso ilimitado à impressora</p>
        <p><i class="fas fa-coffee mr-3 opacity-8"></i>Café, chá e água à vontade</p>
        <p><i class="fas fa-piggy-bank mr-3 opacity-8"></i>Descontos exclusivos</p>
        <p><i class="fas fa-briefcase fa-fw mr-3 opacity-8"></i>Sala de reunião por 4 h/mês</p>
        <p><i class="fas fa-building fa-fw mr-3 opacity-8"></i>Endereço comercial</p>
        <p><i class="fas fa-mail-bulk fa-fw mr-3 opacity-8"></i>Serviço de correspondência</p>
      @endcomponent
    </div>