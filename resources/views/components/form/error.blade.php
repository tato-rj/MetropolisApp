@if ($errors->hasBag($bag) && $errors->$bag->has($field))
    <span class="invalid-feedback" role="alert">
        {{ $errors->$bag->first($field) }}
    </span>
@endif