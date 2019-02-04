    <div class="card card--inverse widget-signups">
        <div class="card-body">
            <h4 class="card-title">Cadastros Recentes</h4>
            <h6 class="card-subtitle mb-3">Estes são os mais recentes usuários a cirarem uma conta no site</h6>

            <div class="widget-signups__list">
                @foreach($latestUsers as $user)
                <a data-toggle="tooltip" title="{{$user->name}}" href=""><div class="avatar-char">{{$user->name[0]}}</div></a>
                @endforeach
            </div>
        </div>
    </div>
    