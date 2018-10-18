<nav class="navbar animated animation-fast navbar-expand-lg navbar-dark position-absolute w-100 z-20 py-4 px-5">
  <a class="navbar-brand" href="/"><img src="{{asset('images/logo.svg')}}" width="60"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbar-menu">
    <ul class="navbar-nav mr-auto">

        @include('layouts.navbar.link', ['title' => 'Quem Somos', 'url' => '/quem-somos'])
        @include('layouts.navbar.link', ['title' => 'Planos', 'url' => '/planos'])
        @include('layouts.navbar.link', ['title' => 'Consultoria', 'url' => '/'])
        @include('layouts.navbar.link', ['title' => 'Workshops', 'url' => '/'])
        @include('layouts.navbar.link', ['title' => 'Contato', 'url' => '/contato'])

    </ul>
    @guest

      <a class="btn btn-red rounded-0 my-2 my-sm-0" href="{{route('login')}}"><strong>Área do Cliente</strong></a>

    @else
    LOGGED IN!
    @endguest
  </div>
</nav>
{{-- <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-menu">

            <ul class="navbar-nav mr-auto">

            </ul>


            <ul class="navbar-nav ml-auto">

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav> --}}