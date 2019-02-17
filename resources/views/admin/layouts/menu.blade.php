<nav class="navbar navbar-expand-md bg-light text-muted fixed-left pt-7">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav accordion py-2" id="menu-list">
            <li class="nav-item {{checkActive(['admin.dashboard'], 'text-teal')}} mb-2">
                <a href="{{route('admin.dashboard')}}" class="nav-link link-inherit"><i class="fas fa-home" style="width: 1.8rem"></i>Painel de Controle</a>
            </li>
            <li class="nav-item {{checkActive(['admin.schedule.index'], 'text-teal')}} mb-2">
                <a href="{{route('admin.schedule.index')}}" class="nav-link link-inherit"><i class="fas fa-calendar-alt" style="width: 1.7rem; margin-left: .14rem"></i>Agenda</a>
            </li>
            <li class="nav-item {{checkActive(['admin.users.index'], 'text-teal')}} mb-2">
                <a href="{{route('admin.users.index')}}" class="nav-link link-inherit"><i class="fas fa-users" style="width: 1.8rem"></i>Usuários</a>
            </li>
            <li class="nav-item {{checkActive(['admin.workshops.index', 'admin.workshops.create'], 'text-teal')}} mb-2">
                <a href="{{route('admin.workshops.index')}}" class="nav-link link-inherit"><i class="fas fa-chalkboard-teacher" style="width: 1.8rem"></i>Workshops</a>
            </li>
            <li class="nav-item {{checkActive(['admin.payments.index'], 'text-teal')}} mb-2">
                <a href="{{route('admin.payments.index')}}" class="nav-link link-inherit"><i class="fas fa-credit-card" style="width: 1.8rem"></i>Pagamentos</a>
            </li>
            <li class="nav-item mb-2">
                <a href="" data-toggle="collapse" data-target="#bills-menu" class="nav-link  pb-0 link-none">
                    <span class="{{checkActive(['admin.bills.create', 'admin.bills.pending'], 'text-teal')}}"><i class="fas fa-receipt" style="width: 1.8rem"></i>Cobranças &#9662;</span>
                </a>
                <div id="bills-menu" class="collapse nav-link {{checkActive(['admin.bills.create', 'admin.bills.pending'], 'show')}}" style="margin-left: 1.8rem" data-parent="#menu-list">
                    <a href="{{route('admin.bills.create')}}" class="d-block mb-1 link-none">
                        <span class="{{checkActive(['admin.bills.create'], 'text-teal')}}">Nova</span>
                    </a>
                    <a href="{{route('admin.bills.pending')}}" class="d-block link-none">
                        <span class="{{checkActive(['admin.bills.pending'], 'text-teal')}}">Pendentes</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
