<div class="form-group">
	@include('components.form.label')
	<input type="hidden" id="trix-{{$name}}" name="{{$name}}" value="{{$value ?? old($name)}}">
	<trix-editor 
		class="{{$classes ?? null}}  {{validate($errors->$bag, $name)}}" 
		input="trix-{{$name}}" 
		placeholder="{{$placeholder ?? snake_str($name)}}" 
		style="height: {{$height ?? '280px'}}"
		{{$required ?? 'required'}}>{!! $value ?? old($name) !!}</trix-editor>
	
	@include('components/form/error', ['bag' => $bag, 'field' => $name])
</div>