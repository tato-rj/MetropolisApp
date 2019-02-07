<div class="form-group">
	<textarea 
		class="form-control {{$classes ?? null}} {{validate($errors->$bag, $name)}}" 
		{{$required ?? 'required'}}  
		name="{{$name}}" 
		rows="{{$rows ?? 4}}" 
		@if(! empty($limit))
		maxlength="{{$limit}}"
		@endif
		placeholder="{{$label ?? snake_str($name)}} {{! empty($limit) ? '(limite de ' . $limit . ' caracteres)' : null}}">{{old($name)}}</textarea>

	@include('components/form/error', ['bag' => $bag, 'field' => $name])
</div>