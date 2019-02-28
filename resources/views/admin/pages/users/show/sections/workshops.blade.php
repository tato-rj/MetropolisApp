<table class="table table-hover" id="workshop-table">
    <thead>
      <tr>
        <th class="border-0" scope="col">Data</th>
        <th class="border-0" scope="col">Workshop</th>
        <th class="border-0" scope="col">Valor</th>
        <th class="border-0" scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach($workshops as $workshop)
      <tr class="cursor-pointer reservation-item" data-url-status="{{route('status.workshop', ['reservation_id' => $workshop->reservation->id, 'user_type' => get_class($user)])}}" data-modal="#event-modal" title="Clique para ver mais detalhes">
        <td>{{$workshop->starts_at->format('d/m/Y')}}</td>
        <td>{{$workshop->name}}</td>
        <td>{{feeToString($workshop->fee)}}</td>
        <td class="text-{{$workshop->reservation->statusColor}}">{{$workshop->reservation->status}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>