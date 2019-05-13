<table class="table table-hover" id="payments-table">
  <thead>
    <tr>
      <th class="border-0" scope="col">Data</th>
      <th class="border-0" scope="col">Evento</th>
      <th class="border-0" scope="col">Usuário</th>
      <th class="border-0" scope="col">Valor</th>
      <th class="border-0" scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    @foreach($payments as $payment)
    <tr class="{{$payment->reservation()->exists() ? null : 'opacity-4'}}">
      <td>{{$payment->created_at->format('d/m/Y')}}</td>
      <td>{{$payment->reservation_ame}}</td>
      <td>{{$payment->user->name}}</td>
      <td>{{feeToString($payment->reservation_fee)}}</td>
      @if($payment->reservation()->exists())
      <td style="width:16.66%" class="text-{{$payment->reservation->statusColor}}">{{$payment->reservation->status}}</td>
      @else
      <td style="width:16.66%" class="text-danger">Removido</td>
      @endif
    </tr>
    @endforeach
  </tbody>
</table>