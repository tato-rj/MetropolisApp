<table class="table table-hover" id="payments-table">
  <thead>
    <tr>
      <th class="border-0" scope="col">Criado em</th>
      <th class="border-0" scope="col">Nome</th>
      <th class="border-0" scope="col">Desconto</th>
      <th class="border-0" scope="col">Validade</th>
      <th class="border-0" scope="col">Limite</th>
      <th class="border-0" scope="col">Número de usos</th>
      <th class="border-0" scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach($coupons as $coupon)
    <tr class="{{$coupon->isValid() ? null : 'opacity-4'}}">
      <td>{{$coupon->created_at->format('d/m/Y')}}</td>
      <td>{{$coupon->name}}</td>
      <td>{{$coupon->discount}}%</td>
      <td>{{$coupon->expires_at ? $coupon->expires_at->format('d/m/Y') : 'Para sempre'}}</td>
      <td>{{$coupon->limit ?? 'Uso ilimitado'}}</td>
      <td>{{$coupon->used}}</td>
      <td class="text-right">
        <a href="#" data-url="{{route('admin.coupons.destroy', $coupon->id)}}" data-toggle="modal" data-target="#delete-confirm" class="delete text-danger"><i class="far fa-trash-alt align-middle"></i></a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>