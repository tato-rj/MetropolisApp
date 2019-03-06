<nav class="navbar animated animation-fast navbar-expand-lg navbar-dark position-absolute w-100 z-20 py-4">
  <a class="navbar-brand" href="/"><img src="{{asset('images/brand/logo.svg')}}" width="60"></a>
  <button class="navbar-toggler z-10 hamburger hamburger--squeeze" style="top: 10px; right: 14px;" data-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="hamburger-box">
      <span class="hamburger-inner"></span>
    </span>
  </button>

  <div class="collapse navbar-collapse" id="navbar-menu">
    <ul class="navbar-nav mr-auto">

        @include('layouts.navbar.link', ['title' => 'Quem Somos', 'url' => '/quem-somos'])
        @include('layouts.navbar.link', ['title' => 'Planos', 'url' => '/planos'])
        @include('layouts.navbar.link', ['title' => 'Consultoria', 'url' => '/consultoria'])
        @include('layouts.navbar.link', ['title' => 'Workshops', 'url' => route('workshops.index')])
        @include('layouts.navbar.link', ['title' => 'Contato', 'url' => '/contato'])

    </ul>
    @guest
    <a class="btn btn-red my-2 my-sm-0" href="{{route('client.home')}}">Área do Cliente</a>
    @else
    <div class="btn-group">
        <a class="btn btn-red my-2 my-sm-0" href="{{route('client.home')}}"><i class="fas fa-user mr-2"></i>Painel de Controle</a>
        <form method="POST" action="{{route('logout')}}">
            @csrf
            <button type="submit" id="logout" class="btn btn-light my-2 my-sm-0" href="{{route('logout')}}">Sair</button>
        </form>
    </div>
    @endguest
  </div>
</nav>
