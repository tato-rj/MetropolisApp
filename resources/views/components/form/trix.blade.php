<div class="form-group">
	<input type="hidden" id="trix-{{$name}}" name="{{$name}}" value="{{$value ?? null}}">
	<trix-editor 
		class="{{$classes ?? null}}  {{validate($errors->$bag, $name)}}" 
		input="trix-{{$name}}" 
		placeholder="{{$label ?? snake_str($name)}}" 
		style="height: {{$height ?? '280px'}}"
		{{$required ?? 'required'}}></trix-editor>
	
	@include('components/form/error', ['bag' => $bag, 'field' => $name])
</div>