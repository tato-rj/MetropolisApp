<nav class="navbar navmenu navbar-expand-md bg-light text-muted fixed-left pt-8 px-4">
    <div class="collapse navbar-collapse">
        <div class="accordion" id="menu-list">
            <div class="d-inline-block align-top">
                <ul class="list-flat text-center menu-icons">
                    @include('admin.layouts.menu.item', ['routes' => ['admin.dashboard'], 'page' => 'dashboard', 'icon' => 'home'])
                    @include('admin.layouts.menu.item', ['routes' => ['admin.schedule.index'], 'page' => 'schedule.index', 'icon' => 'calendar'])
                    @include('admin.layouts.menu.item', ['routes' => ['admin.users.index'], 'page' => 'users.index', 'icon' => 'users'])
                    @include('admin.layouts.menu.item', ['routes' => ['admin.workshops.index', 'admin.workshops.create'], 'page' => 'workshops.index', 'icon' => 'chalkboard-teacher'])
                    @include('admin.layouts.menu.item', ['routes' => ['admin.payments.index'], 'page' => 'payments.index', 'icon' => 'credit-card'])
                    @include('admin.layouts.menu.collapse', ['routes' => ['admin.bills.create', 'admin.bills.pending'], 'collapseId' => 'bills', 'icon' => 'university'])
                </ul>
            </div>
            <div class="d-inline-block align-top">
                <ul class="list-flat ml-2 menu-labels">
                    @include('admin.layouts.menu.item', ['routes' => ['admin.dashboard'], 'page' => 'dashboard', 'label' => 'Painel de Controle'])
                    @include('admin.layouts.menu.item', ['routes' => ['admin.schedule.index'], 'page' => 'schedule.index', 'label' => 'Agenda'])
                    @include('admin.layouts.menu.item', ['routes' => ['admin.users.index'], 'page' => 'users.index', 'label' => 'Usuários'])
                    @include('admin.layouts.menu.item', ['routes' => ['admin.workshops.index', 'admin.workshops.create'], 'page' => 'workshops.index', 'label' => 'Workshops'])
                    @include('admin.layouts.menu.item', ['routes' => ['admin.payments.index'], 'page' => 'payments.index', 'label' => 'Pagamentos'])
                    @include('admin.layouts.menu.collapse', ['routes' => ['admin.bills.create', 'admin.bills.pending'], 'collapseId' => 'bills', 'label' => 'Cobranças', 'subLabels' => ['Nova', 'Pendentes']])
                </ul>
            </div>
        </div>
    </div>

    <div class="position-absolute text-center w-100 bg-grey-lighter" style="bottom: 0; left: 0;">
        <button class="btn bg-transparent text-dark" id="toggle-menu"><i class="fas fa-angle-left"></i></button>
    </div>
</nav>
