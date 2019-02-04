<header class="header">
    <div class="navigation-trigger hidden-xl-up" data-ma-action="aside-open" data-ma-target=".sidebar">
        <div class="navigation-trigger__inner">
            <i class="navigation-trigger__line"></i>
            <i class="navigation-trigger__line"></i>
            <i class="navigation-trigger__line"></i>
        </div>
    </div>

    <div class="header__logo hidden-sm-down">
        <a href="/admin"><img src="{{asset('images/brand/logo_white.svg')}}" width="60"></a>
    </div>

    <ul class="top-nav">
        <li class="dropdown hidden-xs-down">
            <a href="" data-toggle="dropdown"><i class="zmdi zmdi-apps" style="font-size: 2em"></i></a>

            <div class="dropdown-menu dropdown-menu-right dropdown-menu--block" role="menu">
                <div class="row app-shortcuts">
                    <a class="col-4 app-shortcuts__item" href="https://www.digitalocean.com/">
                        <i class="fab fa-digital-ocean"></i>
                        <small class="">Host</small>
                        <span class="app-shortcuts__helper bg-red"></span>
                    </a>
                    <a class="col-4 app-shortcuts__item" href="https://dev.pagseguro.uol.com.br/">
                        <i class="fas fa-dollar-sign"></i>
                        <small class="">Pagseguro</small>
                        <span class="app-shortcuts__helper bg-blue"></span>
                    </a>
                    <a class="col-4 app-shortcuts__item" href="#">
                        <i class="fas fa-envelope"></i>
                        <small class="">Webmail</small>
                        <span class="app-shortcuts__helper bg-teal"></span>
                    </a>
                </div>
            </div>
        </li>
    
        <li class="top-nav__notifications">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt fa-lg mt-1"></i>
                <form id="logout-form" action="{{ route('logout', ['guard' => 'admin']) }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form> 
            </a>
        </li>
    </ul>
</header>