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
  					<tr class="cursor-pointer" title="Clique para ver mais detalhes" data-toggle="modal" data-target="#payment-modal">
  						<td style="width:16.66%">{{$payment->created_at->format('d/m/Y')}}</td>
  						<td style="width:50%">{{$payment->reservation->name}}</td>
  						<td style="width:16.66%">{{feeToString($payment->reservation->fee)}}</td>
  						<td style="width:16.66%" class="text-{{$payment->reservation->statusColor}}">{{$payment->reservation->status}}</td>
  					</tr>
  					@endforeach
  				</tbody>
  			</table>
  		</div>
      @endif
  	</div>
  </div>
</section>