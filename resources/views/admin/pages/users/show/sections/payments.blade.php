<table class="table table-hover" id="payments-table">
    <thead>
      <tr>
        <th class="border-0" scope="col">Data</th>
        <th class="border-0" scope="col">Evento</th>
        <th class="border-0" scope="col">Valor</th>
        <th class="border-0" scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach($payments as $payment)
      <tr>
        <td>{{$payment->created_at->format('d/m/Y')}}</td>
        <td>{{$payment->reservation->name}}</td>
        <td>{{feeToString($payment->reservation->fee)}}</td>
        <td class="text-{{$payment->reservation->statusColor}}">{{$payment->reservation->status}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>