<div class="col-lg-8 col-10 mx-auto">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" aria-describedby="email" placeholder="Meu e-mail" value="{{old('email')}}">

            @include('components/form/error', ['field' => 'email'])
        </div>

        <div class="form-group mb-2">
            <input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" aria-describedby="password" placeholder="Password">

            @include('components/form/error', ['field' => 'password'])
        </div>

        <div class="form-group mb-4 custom-control custom-checkbox">
            <input id="remember" type="checkbox" name="remember" 
                    class="custom-control-input {{ $errors->has('remember') ? ' is-invalid' : '' }}" {{ old('remember') ? ' checked' : '' }}>
            <label class="custom-control-label" for="remember">Permanecer conectado</label>

            @include('components/form/error', ['field' => 'remember'])
        </div>

        <button type="submit" class="btn btn-red btn-block">Continuar</button>
    </form>
    <div class="mb-4">
        <p class="lead text-muted text-center my-3">- ou se preferir -</p>
        <a href="" class="btn btn-facebook btn-block text-left"><i class="fab fa-facebook fa-lg border-right mr-3" style="width: 34px"></i>Continuar com Facebook</a>
        <a href="" class="btn btn-google btn-block text-left"><i class="fab fa-google border-right mr-3" style="width: 34px"></i>Continuar com Google</a>
    </div>
    <div>
        <p class="mb-0">
            <small>Esqueceu o seu password? <span class="text-blue"><a href="{{route('password.request')}}" class="link-no-blue">Clique aqui</a></span></small>
        </p>
        <p class="m-0">
            <small>Ainda não é membro? <span class="text-blue"><a href="{{route('register')}}" class="link-no-blue">Criar a minha conta</a></span></small>
        </p>
    </div>
</div>