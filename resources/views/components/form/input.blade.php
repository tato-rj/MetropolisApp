<div class="form-group">
	@include('components.form.label')
	<input 
		class="form-control {{$classes ?? null}} {{validate($errors->$bag, $name)}}" 
		{{$required ?? 'required'}} 
		type="{{$type ?? 'text'}}" 
		name="{{$name}}" 
		placeholder="{{$placeholder ?? snake_str($name)}}" 
		value="{{$value ?? old($name)}}">

	@include('components/form/error', ['bag' => $bag, 'field' => $name])
</div>