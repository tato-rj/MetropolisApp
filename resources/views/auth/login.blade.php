@extends('layouts.raw')

@section('content')
<section class="container-fluid">
    <div class="row" style="min-height: 100vh;">
        <div class="col-lg-6 col-md-6 col-12">
            <a href="/" class="btn-back-thin"></a>
            <div class="d-flex flex-center h-100">
                <div class="row">
                    <div class="col-12 mb-2 text-center">
                        <img src="{{asset('images/logo.svg')}}" width="100" class="mb-3">
                        <p class="lead-lg">ÁREA DO CLIENTE</p>
                    </div>
                    <div class="col-lg-8 col-10 mx-auto">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <input type="email" name="email" class="form-control rounded-0 {{ $errors->has('email') ? ' is-invalid' : '' }}" aria-describedby="email" placeholder="Meu e-mail" value="{{old('email')}}">

                                @include('components/form/error', ['field' => 'email'])
                            </div>

                            <div class="form-group">
                                <input type="password" name="password" class="form-control rounded-0 {{ $errors->has('password') ? ' is-invalid' : '' }}" aria-describedby="password" placeholder="Password">
                                
                                @include('components/form/error', ['field' => 'password'])
                            </div>

                            <button type="submit" class="btn btn-red rounded-0 btn-block">LOGIN</button>
                        </form>
                        <div class="mb-4">
                            <p class="lead text-muted text-center my-3">- ou se preferir -</p>
                            <a href="" class="btn btn-facebook btn-block rounded-0 text-left"><i class="fab fa-facebook fa-lg border-right mr-3" style="width: 34px"></i>Login com Facebook</a>
                            <a href="" class="btn btn-google btn-block rounded-0 text-left"><i class="fab fa-google border-right mr-3" style="width: 34px"></i>Login com Google</a>
                        </div>
                        <div>
                            <p class="mb-0">
                                <small>Esqueceu o seu passowrd? <span class="text-blue"><a href="/" class="link-no-blue">Clique aqui</a></span></small>
                            </p>
                            <p class="m-0">
                                <small>Ainda não é membro? <span class="text-blue"><a href="{{route('register')}}" class="link-no-blue">Criar a minha conta</a></span></small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12 d-none d-sm-block">
            <div class="w-100 h-100 bg-align-center" style="background-image: url({{asset('images/footer.jpg')}})">
                <div class="overlay-darkest"></div>
                <div class="d-flex w-100 h-100 align-items-center text-white">
                    <div class="z-10">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
