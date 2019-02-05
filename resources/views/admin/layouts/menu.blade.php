<nav class="navbar navbar-expand-md bg-light text-muted fixed-left pt-7">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav py-2">
            <li class="nav-item {{checkActive(['admin.dashboard'], 'text-teal')}} mb-2">
                <a href="{{route('admin.dashboard')}}" class="nav-link link-inherit"><i class="fas fa-home" style="width: 1.8rem"></i>Painel de Controle</a>
            </li>
            <li class="nav-item {{checkActive(['admin.schedule'], 'text-teal')}} mb-2">
                <a href="{{route('admin.schedule')}}" class="nav-link link-inherit"><i class="fas fa-calendar-alt" style="width: 1.7rem; margin-left: .14rem"></i>Agenda</a>
            </li>
            <li class="nav-item {{checkActive(['admin.users'], 'text-teal')}} mb-2">
                <a href="{{route('admin.users')}}" class="nav-link link-inherit"><i class="fas fa-users" style="width: 1.8rem"></i>Usuários</a>
            </li>
            <li class="nav-item {{checkActive(['admin.workshops'], 'text-teal')}} mb-2">
                <a href="{{route('admin.workshops')}}" class="nav-link link-inherit"><i class="fas fa-chalkboard-teacher" style="width: 1.8rem"></i>Workshops</a>
            </li>
            <li class="nav-item {{checkActive(['admin.payments'], 'text-teal')}} mb-2">
                <a href="{{route('admin.payments')}}" class="nav-link link-inherit"><i class="fas fa-credit-card" style="width: 1.8rem"></i>Pagamentos</a>
            </li>
        </ul>
    </div>
</nav>
