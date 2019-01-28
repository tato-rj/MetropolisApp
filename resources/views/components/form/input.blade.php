<div class="form-group">
	<input 
		class="form-control {{$classes ?? null}} {{validate($errors->$bag, $name)}}" 
		{{$required ?? 'required'}} 
		type="{{$type ?? 'text'}}" 
		name="{{$name}}" 
		placeholder="{{$label ?? snake_str($name)}}" 
		value="{{old($name)}}">

	@include('components/form/error', ['bag' => $bag, 'field' => $name])
</div>