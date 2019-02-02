<div class="col-lg-8 col-10 mx-auto">
    @if (session('status'))
        <div class="alert alert-success text-center" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group">
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                name="email" value="{{ old('email') }}" placeholder="Email" required>

            @include('components/form/error', ['field' => 'email'])
        </div>

        <button type="submit" class="btn btn-red btn-block">Enviar o link para mudar o password</button>
    </form>
</div>