<div class="col-lg-8 col-10 mx-auto">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <input type="text" name="name" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" aria-describedby="email" placeholder="Nome completo" value="{{old('name')}}">

            @include('components/form/error', ['field' => 'name'])
        </div>
        <div class="form-group">
            <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" aria-describedby="email" placeholder="Email" value="{{old('email')}}">

            @include('components/form/error', ['field' => 'email'])
        </div>

        <div class="form-group">
            <input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" aria-describedby="password" placeholder="Password">
            @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <input type="password" name="password_confirmation" class="form-control {{ $errors->has('password-confirm') ? ' is-invalid' : '' }}" aria-describedby="password-confirm" placeholder="Confirme o seu password">
        </div>

        <button type="submit" class="btn btn-red btn-block">CONTINUAR</button>
    </form>
    <div class="mb-4">
        <p class="lead text-muted text-center my-3">- ou se preferir -</p>
        <a href="" class="btn btn-facebook btn-block text-left"><i class="fab fa-facebook fa-lg border-right mr-3" style="width: 34px"></i>Continuar com Facebook</a>
        <a href="" class="btn btn-google btn-block text-left"><i class="fab fa-google border-right mr-3" style="width: 34px"></i>Continuar com Google</a>
    </div>
    <div>
        <p class="m-0">
            <small>Já possui cadastro? <span class="text-blue"><a href="{{route('login')}}" class="link-no-blue">Fazer o login</a></span></small>
        </p>
    </div>
</div>