    <div class="row">
      @component('components.plans.card', ['title' => 'MENSAL', 'price' => '720', 'discount' => '10', 'color' => 'indigo'])
        <p><i class="fas fa-door-open fa-fw mr-3 fa-lg opacity-8"></i>Co-working ilimitado</p>
        <p><i class="fas fa-wifi fa-fw mr-3 fa-lg opacity-8"></i>Wifi de alta velocidade</p>
        <p><i class="fas fa-print fa-fw mr-3 fa-lg opacity-8"></i>Acesso ilimitado à impressora</p>
        <p><i class="fas fa-piggy-bank mr-3 fa-lg opacity-8"></i>Descontos exclusivos</p>
      @endcomponent

      @component('components.plans.card', ['title' => 'SEMESTRAL', 'price' => '712', 'discount' => '15', 'color' => 'orange'])
        <p><i class="fas fa-door-open fa-fw mr-3 fa-lg opacity-8"></i>Co-working ilimitado</p>
        <p><i class="fas fa-wifi fa-fw mr-3 fa-lg opacity-8"></i>Wifi de alta velocidade</p>
        <p><i class="fas fa-briefcase fa-fw mr-3 fa-lg opacity-8"></i>Sala de reunião por 2 h/mês</p>
        <p><i class="fas fa-print fa-fw mr-3 fa-lg opacity-8"></i>Acesso ilimitado à impressora</p>
        <p><i class="fas fa-piggy-bank mr-3 fa-lg opacity-8"></i>Descontos exclusivos</p>
      @endcomponent

      @component('components.plans.card', ['title' => 'ANUAL', 'price' => '699', 'discount' => '20', 'color' => 'green'])
        <p><i class="fas fa-door-open fa-fw mr-3 fa-lg opacity-8"></i>Co-working ilimitado</p>
        <p><i class="fas fa-building fa-fw mr-3 fa-lg opacity-8"></i>Endereço comercial</p>
        <p><i class="fas fa-mail-bulk fa-fw mr-3 fa-lg opacity-8"></i>Serviço de correspondência</p>
        <p><i class="fas fa-wifi fa-fw mr-3 fa-lg opacity-8"></i>Wifi de alta velocidade</p>
        <p><i class="fas fa-briefcase fa-fw mr-3 fa-lg opacity-8"></i>Sala de reunião por 4 h/mês</p>
        <p><i class="fas fa-print fa-fw mr-3 fa-lg opacity-8"></i>Acesso ilimitado à impressora</p>
        <p><i class="fas fa-piggy-bank mr-3 fa-lg opacity-8"></i>Descontos exclusivos</p>
      @endcomponent
    </div>