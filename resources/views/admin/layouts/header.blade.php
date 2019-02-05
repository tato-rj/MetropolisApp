<nav class="navbar fixed-top bg-teal">
  <a class="navbar-brand">
  	<img src="{{asset('images/brand/logo_white.svg')}}" width="60">
  </a>
  <form method="POST" action="{{route('logout')}}">
  	@csrf
  	<button type="submit" id="logout" class="bg-transparent border-0 cursor-pointer" href="{{route('logout')}}">
  		<i class="fas fa-sign-out-alt fa-lg text-white"></i>
  	</button>
  </form>
</nav>