<div class="col-lg-8 col-10 mx-auto">
    <form method="POST" action="{{ route('admin.login.submit') }}" class="mb-2">
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

        <button type="submit" class="btn btn-red btn-block">Entrar</button>
    </form>
    <div>
        <p class="mb-0">
            <small>Esqueceu o seu password? <span class="text-blue"><a href="{{route('admin.password.request')}}" class="link-no-blue">Clique aqui</a></span></small>
        </p>
    </div>
</div>