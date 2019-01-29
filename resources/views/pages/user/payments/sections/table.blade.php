<section class="mb-7 mt-6 container">
  <div class="row">
  	<div class="col-default">
      @if(auth()->user()->payments->isEmpty())
      <div class="py-6 text-muted">Você ainda não realizou nenhum pagamento</div>
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
  					<tr class="cursor-pointer" title="Clique para ver mais detalhes">
  						<td style="width:16.66%">{{$payment->created_at->format('d/m/Y')}}</td>
  						<td style="width:50%">{{$payment->product->name}}</td>
  						<td style="width:16.66%">{{feeToString($payment->product->fee)}}</td>
  						<td style="width:16.66%" class="text-{{$payment->product->statusColor}}">{{$payment->product->status}}</td>
  					</tr>
  					@endforeach
  				</tbody>
  			</table>
  		</div>
      @endif
  	</div>
  </div>
</section>