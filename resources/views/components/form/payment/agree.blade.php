<div class="form-group ml-4 custom-control custom-checkbox">
    <input id="agree" type="checkbox" name="agree" required
            class="custom-control-input {{ $errors->has('agree') ? ' is-invalid' : '' }}" {{ old('agree') ? ' checked' : '' }}>
    <label class="custom-control-label" for="agree">Eu li e aceito os <a href="{{route('terms')}}" target="_blank" class="link-blue">termos e condições</a></label>

    @include('components/form/error', ['field' => 'agree'])
</div>