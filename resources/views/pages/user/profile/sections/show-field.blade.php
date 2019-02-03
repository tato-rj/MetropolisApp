<div class="m-2 form-group">
  <label class="m-0"><small>{{$label}}</small></label>
  <p class="m-0">{!! $value !!}</p>
  <input type="hidden" class="form-control {{ $errors->has($field) ? ' is-invalid' : '' }}" name="{{$field}}" value="{{$value}}">
  @include('components/form/error', ['field' => $field])
</div>