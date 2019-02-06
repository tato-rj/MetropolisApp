    <div class="card bg-grey-darker text-light border-0 shadow-sm">
        <div class="card-body">
            <div class="mb-4">
                <h5 class="mb-1">Cadastros Recentes</h5>
                <p class="m-0">Últimos usuários a criarem uma conta no site</p>
            </div>

            <div class="d-flex flex-wrap justify-content-center align-items-center">
                @foreach($latestUsers as $user)
                <a data-toggle="tooltip" data-placement="top" title="{{$user->name}}" href="{{route('admin.users.edit', $user->id)}}" class="link-none">
                    <div class="bg-grey-dark text-white rounded-circle d-flex flex-center m-1" style="width: 3rem; height: 3rem; font-size: 1.2em; padding-bottom: 1px">{{$user->name[0]}}</div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
    