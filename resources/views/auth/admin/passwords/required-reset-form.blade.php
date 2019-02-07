<div class="col-lg-8 col-10 mx-auto">
    <p class="text-center mb-4">Para a sua segurança, por favor crie um novo password.</p>
    <form method="POST" action="{{ route('admin.password.required-save') }}">
        @csrf

        <div class="form-group">
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                name="email" value="{{ $email ?? old('email') }}" placeholder="Email" required autofocus>

            @include('components/form/error', ['field' => 'email'])
        </div>

        <div class="form-group">
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Novo password" name="password" required>

            @include('components/form/error', ['field' => 'password'])
        </div>

        <div class="form-group">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirme o novo password" required>
        </div>

        <button type="submit" class="btn btn-red btn-block">Salvar o novo password</button>
    </form>
</div>