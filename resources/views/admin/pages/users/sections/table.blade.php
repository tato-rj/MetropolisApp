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
    <tr class="cursor-pointer">
      <td><a title="Clique para editar" href="{{route('admin.users.edit', $user->id)}}" class="link-none"><i class="fas fa-external-link-alt mr-2 fa-sm text-teal"></i>{{$user->name}}</a></td>
      <td><a title="Clique para editar" href="{{route('admin.users.edit', $user->id)}}" class="link-none">{{$user->email}}</a></td>
      <td>{{$user->membership()->exists() ? $user->membership->plan->displayName : '-'}}</td>
      <td>{{$user->events()->count()}}</td>
      <td>{{$user->created_at->format('d/m/Y')}}</td>
    </tr>
    @endforeach
  </tbody>
</table>