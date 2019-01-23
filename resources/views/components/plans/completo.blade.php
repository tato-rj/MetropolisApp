    <div class="row">
      @include('components.plans.card', ['plan' => $completePlans->find(4), 'bonus' => 'Qualquer sala por 40 min/dia'])

      @include('components.plans.card', ['plan' => $completePlans->find(5), 'bonus' => 'Qualquer sala por 3 h/semana'])

      @include('components.plans.card', ['plan' => $completePlans->find(6), 'bonus' => 'Qualquer sala por 8 h/mês'])
    </div>