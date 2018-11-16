<nav class="navbar animated animation-fast navbar-expand-lg navbar-dark position-absolute w-100 z-20 py-4 px-5">
  <a class="navbar-brand" href="/"><img src="{{asset('images/brand/logo.svg')}}" width="60"></a>
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
    <a class="btn btn-red my-2 my-sm-0" href="{{route('client.home')}}"><strong>Área do Cliente</strong></a>
    @else
    <div class="btn-group">
        <a class="btn btn-red my-2 my-sm-0" href="{{route('client.home')}}"><strong>Painel de Controle</strong></a>
        <form method="POST" action="{{route('logout')}}">
            @csrf
            <button type="submit" id="logout" class="btn btn-light my-2 my-sm-0" href="{{route('logout')}}">
                <strong>Sair</strong>
            </button>
        </form>
    </div>
    @endguest
  </div>
</nav>
