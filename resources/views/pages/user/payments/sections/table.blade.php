<section class="mb-7 mt-6 container">
  <div class="row">
  	<div class="col-default">
      @if(auth()->user()->payments->isEmpty())
      <div class="py-4 text-muted text-center lead">Você ainda não realizou nenhum pagamento</div>
      @else
  		<div class="table-responsive-lg">
  			<table class="table table-hover table-bordered">
  				<thead>
  					<tr class="border-bottosm">
  						<th style="width:16.66%">Data</th>
  						<th style="width:50%">Evento</th>
  						<th style="width:16.66%">Valor</th>
  						<th style="width:16.66%">Status</th>
  					</tr>
  				</thead>
  				<tbody>
  					@foreach(auth()->user()->payments as $payment)
  					<tr class="{{$payment->reservation()->exists() ? null : 'opacity-4'}}">
  						<td style="width:16.66%">{{$payment->created_at->format('d/m/Y')}}</td>
  						<td style="width:50%">{{$payment->reservation_name}}</td>
  						<td style="width:16.66%">{{feeToString($payment_reservation->fee)}}</td>
              @if($payment->reservation()->exists())
  						<td style="width:16.66%" class="text-{{$payment->reservation->statusColor}}">{{$payment->reservation->status}}</td>
              @else
              <td style="width:16.66%" class="text-danger">Removido</td>
              @endif
  					</tr>
  					@endforeach
  				</tbody>
  			</table>
  		</div>
      @endif
  	</div>
  </div>
</section>