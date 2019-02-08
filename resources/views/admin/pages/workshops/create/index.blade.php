@extends('admin.layouts.app')

@push('header')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.4.3/cropper.min.css">
<style type="text/css">
.image-container canvas { width: 100% !important; }
</style>
@endpush

@section('content')

<form method="POST" action="{{route('admin.workshops.store')}}" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-6">
			@input(['bag' => 'default', 'name' => 'name', 'placeholder' => 'Nome'])
			@textarea(['bag' => 'default', 'name' => 'headline', 'placeholder' => 'Resumo','limit' => 255])

			<div class="form-row form-group">
				<div class="col">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text rounded-0">R$</span>
						</div>
						<input type="text" name="fee" class="form-control" placeholder="Preço" value="{{old('fee')}}">
						<div class="input-group-append">
							<span class="input-group-text rounded-0">,00</span>
						</div>
					</div>
					@include('components/form/error', ['bag' => 'default', 'field' => 'fee'])
				</div>
				<div class="col">
					<div class="input-group">
						<input type="text" name="capacity" class="form-control" placeholder="Capacidade" value="{{old('capacity')}}">
						<div class="input-group-append">
							<span class="input-group-text rounded-0">pessoas</span>
						</div>
					</div>
					@include('components/form/error', ['bag' => 'default', 'field' => 'capacity'])
				</div>
			</div>

			<div class="form-row form-group">
				<div class="col-6">
					@include('components.calendar.input', ['blank' => true])
					@include('components/form/error', ['bag' => 'default', 'field' => 'date'])
				</div>
				<div class="col">
					<select name="start_time" class="form-control">
						<option disabled selected>Começa às</option>
						@for($i = office()->day_starts_at; $i <= office()->day_ends_at + 4; $i++)
						<option value="{{$i}}" @old('start_time', $i) selected @endold>{{$i}}:00h</option>
						@endfor
					</select>
					@include('components/form/error', ['bag' => 'default', 'field' => 'start_time'])
				</div>
				<div class="col">
					<select name="end_time" class="form-control">
						<option disabled selected>Termina às</option>
						@for($i = office()->day_starts_at; $i <= office()->day_ends_at + 4; $i++)
						<option value="{{$i}}" @old('end_time', $i) selected @endold>{{$i}}:00h</option>
						@endfor
					</select>
					@include('components/form/error', ['bag' => 'default', 'field' => 'end_time'])
				</div>
			</div>

			@trix(['bag' => 'default', 'name' => 'description', 'placeholder' => 'Descrição'])
		</div>
		<div class="col-6">
			@image(['name' => 'cover_image', 'image' => asset('images/covers/placeholder-image.png'), 'empty' => true])
		</div>
	</div>
	<div class="mt-4 pt-4 border-top text-right">
		<button type="submit" class="btn btn-red">Criar novo workshop</button>
	</div>
</form>

@endsection

@push('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.4.3/cropper.min.js"></script>
<script type="text/javascript">
(new CustomDatePicker('#datepicker')).create();
(new SimpleCropper({
	imageInput: 'input#image-input',
	uploadButton: '#upload-button',
	confirmButton: '#confirm-button',
	cancelButton: '#cancel-button',
	submitButton: 'button[type="submit"]'
})).create();
</script>
@endpush