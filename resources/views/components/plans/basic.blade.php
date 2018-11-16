    <div class="row">
      @include('components.plans.card', ['plan' => $basicPlans->find(1), 'bonus' => 'Sala Tóquio por 40 min/dia'])

      @include('components.plans.card', ['plan' => $basicPlans->find(2), 'bonus' => 'Sala Tóquio por 3 h/semana'])

      @include('components.plans.card', ['plan' => $basicPlans->find(3), 'bonus' => 'Sala Tóquio por 8 h/mês'])
    </div>