@extends('admin.layouts.app')

@push('header')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.4.3/cropper.min.css">
@endpush

@section('content')

<form method="POST" action="{{route('admin.workshops.store')}}" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-6">
			@input(['bag' => 'default', 'name' => 'name', 'label' => 'Nome'])
			@textarea(['bag' => 'default', 'name' => 'headline', 'label' => 'Resumo','limit' => 255])

			<div class="form-row">
				<div class="col">
					@input(['bag' => 'default', 'name' => 'fee', 'label' => 'Preço'])
				</div>
				<div class="col">
					@input(['bag' => 'default', 'name' => 'capacity', 'label' => 'Capacidade'])
				</div>
			</div>

			<div class="form-row">
				<div class="col">
					@input(['bag' => 'default', 'name' => 'day', 'label' => 'Dia do evento'])
				</div>
				<div class="col">
					@input(['bag' => 'default', 'name' => 'starts_at', 'label' => 'Começa às'])
				</div>
				<div class="col">
					@input(['bag' => 'default', 'name' => 'ends_at', 'label' => 'Termina às'])
				</div>
			</div>

			@trix(['bag' => 'default', 'name' => 'description', 'label' => 'Descrição'])
		</div>
		<div class="col-6">
			@image()
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
selectImage = function(input, element) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function(e) {
			$(element).attr('src', e.target.result);
			enableCropper();
		}
		reader.readAsDataURL(input.files[0]);
	}
}

confirmImage = function() {
	canvas = cropper.getCroppedCanvas();
	$imageInput.val(canvas.toDataURL());
	console.log(canvas.toDataURL());
}

enableCropper = function() {
    	let image = document.getElementById('image');

    	cropper = new Cropper(image, {
    		aspectRatio: 16 / 10.5,
    		viewMode: 1,
    		movable: false,
    		scalable: false,
    		rotatable: false,
    		zoomOnTouch: false,
    		zoomOnWheel: false,
    		crop(event) {
    			$('input[name="cropped_width"]').val(event.detail.width);
    			$('input[name="cropped_height"]').val(event.detail.height);
    			$('input[name="cropped_x"]').val(event.detail.x);
    			$('input[name="cropped_y"]').val(event.detail.y);
    		},
    	});
}

formatBytes = function(bytes,decimals) {
   if(bytes == 0) return '0 Bytes';
   var k = 1024,
       dm = decimals || 2,
       sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
       i = Math.floor(Math.log(bytes) / Math.log(k));
   return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}

let cropper;
let $imageInput = $('input#image-input');
let $image = $($imageInput.attr('data-target'));
let $uploadButton = $('#upload-button');
let $confirmButton = $('#confirm-button');
let $cancelButton = $('#cancel-button');
let defaultImage = $image.attr('src');

$uploadButton.on('click', function() {
  $('input#image-input').click();
});

$cancelButton.on('click', function() {
	$image.attr('src', defaultImage);
	cropper.destroy();

	$uploadButton.toggle();
	$cancelButton.toggle();
	$confirmButton.toggle();
});

$confirmButton.on('click', function() {
	confirmImage();
});

$imageInput.change(function(event) {
  let target = $(this).attr('data-target');
  let file = event.target.files[0];
  let maxSize = 1048576;

  if (file.name.match(/\.(jpg|jpeg|png)$/i)) {
    if (file.size < maxSize) {

    	selectImage(this, target);

    	$uploadButton.toggle();
    	$cancelButton.toggle();
    	$confirmButton.toggle();

    } else {
      alert('This image is too large ('+formatBytes(file.size)+'). You can\'t upload images larger than '+formatBytes(maxSize)+'.');
    }
  } else {
    alert('This is not a valid image format. Only jpg, jpeg or png will be accepted.');
  }
});
</script>
@endpush