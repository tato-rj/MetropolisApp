<table class="table table-hover" id="users-table">
  <thead>
    <tr>
      <th class="border-0" scope="col">Nome</th>
      <th class="border-0" scope="col">Email</th>
      <th class="border-0" scope="col">Plano</th>
      <th class="border-0" scope="col"># de reservas</th>
      <th class="border-0" scope="col">Cadastro</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
    <tr class="cursor-pointer" data-url="{{route('admin.users.edit', $user->id)}}" title="Clique para editar">
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->membership()->exists() ? $user->membership->plan->displayName : '-'}}</td>
      <td>{{$user->events()->count()}}</td>
      <td>{{$user->created_at->format('d/m/Y')}}</td>
    </tr>
    @endforeach
  </tbody>
</table>