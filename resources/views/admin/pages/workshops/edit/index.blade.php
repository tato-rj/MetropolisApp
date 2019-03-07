@extends('admin.layouts.app')

@push('header')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.4.3/cropper.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('css/dropzone.css')}}">
<style type="text/css">
.dropzone {
  border: 4px dashed #4dc0b5;
  border-radius: 0;
}

.dropzone .dz-message {
  color: #6c757d;
  line-height: 3;
  font-weight: bold;
}

.dropzone .dz-preview .dz-error-message {
  background: #e3342f;
  border-radius: 0;
}

.dropzone .dz-preview .dz-error-message:after {
  border-bottom: 6px solid #e3342f;
}

.dropzone .dz-preview.dz-file-preview .dz-image {
    border-radius: 20px;
    background: linear-gradient(to bottom, #d7f3e3, #a3e4bf);
}
</style>
@endpush

@section('content')

<div class="row mb-2">
	<div class="col-12 mb-4">
		@include('components.form.label', ['label' => 'Material para download'])
		<form action="{{route('admin.workshops.file.store', $workshop->slug)}}" class="dropzone" id="filesDropzone"></form>
	</div>
	<div class="col-12">
		@include('components.workshops.files', ['removable' => true])
	</div>
</div>

<div class="row">
	<div class="col-6">
	<form method="POST" action="{{route('admin.workshops.update', $workshop->slug)}}">
		@csrf
			@input(['bag' => 'default', 'name' => 'name', 'label' => 'Nome', 'value' => $workshop->name])
			@textarea(['bag' => 'default', 'name' => 'headline', 'label' => 'Resumo','limit' => 255, 'value' => $workshop->headline])

			<div class="form-row form-group">
				<div class="col">
					@include('components.form.label', ['label' => 'Preço'])
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text rounded-0">R$</span>
						</div>
						<input type="text" name="fee" class="form-control" placeholder="Preço" value="{{$workshop->fee}}">
						<div class="input-group-append">
							<span class="input-group-text rounded-0">,00</span>
						</div>
					</div>
					@include('components/form/error', ['bag' => 'default', 'field' => 'fee'])
				</div>
				<div class="col">
					@include('components.form.label', ['label' => 'Capacidade'])
					<div class="input-group">
						<input type="text" name="capacity" class="form-control" placeholder="Capacidade" value="{{$workshop->capacity}}">
						<div class="input-group-append">
							<span class="input-group-text rounded-0">pessoas</span>
						</div>
					</div>
					@include('components/form/error', ['bag' => 'default', 'field' => 'capacity'])
				</div>
			</div>

			<div class="form-row form-group">
				<div class="col-6">
					@include('components.form.label', ['label' => 'Data'])
					@include('components.calendar.input', ['value' => $workshop->starts_at])
					@include('components.form.error', ['bag' => 'default', 'field' => 'date'])
				</div>
				<div class="col">
					@include('components.form.label', ['label' => 'Começa às'])
					<select name="start_time" class="form-control">
						<option disabled selected>Começa às</option>
						@for($i = office()->day_starts_at; $i <= office()->day_ends_at + 4; $i++)
						<option value="{{$i}}" @match($workshop->starts_at->hour, $i) selected @endmatch>{{$i}}:00h</option>
						@endfor
					</select>
					@include('components/form/error', ['bag' => 'default', 'field' => 'start_time'])
				</div>
				<div class="col">
					@include('components.form.label', ['label' => 'Termina às'])
					<select name="end_time" class="form-control">
						<option disabled selected>Termina às</option>
						@for($i = office()->day_starts_at; $i <= office()->day_ends_at + 4; $i++)
						<option value="{{$i}}" @match($workshop->ends_at->hour, $i) selected @endmatch>{{$i}}:00h</option>
						@endfor
					</select>
					@include('components/form/error', ['bag' => 'default', 'field' => 'end_time'])
				</div>
			</div>

			@trix(['bag' => 'default', 'name' => 'description', 'label' => 'Descrição', 'value' => $workshop->description])

			<div class="mt-4 pt-4 border-top text-right">
				<button type="submit" class="btn btn-red btn-block">Salvar mudanças no workshop</button>
			</div>
	</form>
	</div>
	<div class="col-6">
		@include('components.form.label', ['label' => 'Imagem principal'])
		<div class="bg-white border p-4">
		<form method="POST" action="{{route('admin.workshops.update', $workshop->slug)}}" enctype="multipart/form-data">
			@csrf
			@image(['name' => 'cover_image', 'image' => asset($workshop->cover_image_path), 'empty' => false])
			<div class="mt-4 pt-4 border-top text-right">
				<button id="submit-image-button" type="submit" class="btn btn-red btn-block">Salvar nova foto</button>
			</div>
		</form>
		</div>
	</div>
</div>

@include('admin.components.modals.delete', [
	'message' => 'Quero deletar o workshop ' . $workshop->name . '.',
	'url' => route('admin.workshops.destroy', $workshop->slug)])

@endsection

@push('scripts')
<script type="text/javascript" src="{{asset('js/vendor/dropzone.js')}}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.4.3/cropper.min.js"></script>

<script type="text/javascript">
$('.remove-file').on('click', function(){
	let $button = $(this);
	let url = $button.attr('data-path');

	if (! $button.hasClass('removing')) {
		$button.addClass('removing');

		$button.find('i').removeClass('fa-times-circle text-red').addClass('fa-hourglass-half text-muted');

		$.ajax({
			url: url,
			method: 'DELETE'
		}).done(function() {
			$button.find('i').addClass('fa-check-circle text-green').removeClass('fa-hourglass-half text-muted');
			$button.parent().fadeOut(function() {
				$(this).remove();
			});
		}).fail(function(data) {
			alert(data.responseJSON);
		}).always(function() {
			$button.removeClass('removing');
		});
	}
});
</script>

<script type="text/javascript">
Dropzone.options.filesDropzone = {
  acceptedFiles: 'image/*,application/.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip',
  maxFilesize: 2,
  maxFiles:8,
  accept: function(file, done) {
    console.log(file);
    done();
  },
  sending: function(file, xhr, formData) {
    formData.append("_token", window.app.csrfToken);
  }
};
Dropzone.prototype.defaultOptions.dictDefaultMessage = "Arraste os arquivos aqui ou clique para fazer o upload";
Dropzone.prototype.defaultOptions.dictFallbackMessage = "O seu browser não suporta essa ação.";
Dropzone.prototype.defaultOptions.dictFallbackText = "Por favor contate o webmaster para fazer o upload desse arquivo.";
Dropzone.prototype.defaultOptions.dictFileTooBig = "Este arquivo é muito grande. Limite é de 2MB.";
Dropzone.prototype.defaultOptions.dictInvalidFileType = "Você não pode fazer upload de arquivos desse tipo.";
Dropzone.prototype.defaultOptions.dictResponseError = "Ocoreu um erro no servidor.";
Dropzone.prototype.defaultOptions.dictCancelUpload = "Cancelar o upload.";
Dropzone.prototype.defaultOptions.dictCancelUploadConfirmation = "Tem certeza de que deseja cancelar esse upload?";
Dropzone.prototype.defaultOptions.dictRemoveFile = "Remover o arquivo";
Dropzone.prototype.defaultOptions.dictMaxFilesExceeded = "Você chegou ao limite de uploads nessa sessão.";
</script>

<script type="text/javascript">
(new CustomDatePicker('#datepicker')).create();
(new SimpleCropper({
	imageInput: 'input#image-input',
	uploadButton: '#upload-button',
	confirmButton: '#confirm-button',
	cancelButton: '#cancel-button',
	submitButton: '#submit-image-button'
})).create();
</script>

<script type="text/javascript">
(function() {
  let uploadUrl, removeUrl, uploadAttachment;
  let button = $('trix-editor').closest('form').find('button[type="submit"]');

  Trix.config.attachments.preview.caption = {
    name: false,
    size: false
  };
  
  uploadUrl = '/admin/workshops/images/upload';
  removeUrl = '/admin/workshops/images/remove';

  document.addEventListener("trix-attachment-add", function(event) {
    let attachment;
    attachment = event.attachment;

    if (attachment.file) {
      return uploadAttachment(attachment);
    }
  });

  document.addEventListener("trix-attachment-remove", function(event) 
  {
  	button.prop('disabled', true);

  	$.post(removeUrl, {'image_path': event.attachment.attachment.previewURL}, function(response){
  		if(! response.passes) {
  			console.log('A imagem foi removida com sucesso.');
  		} else {
  			console.log('Não foi possível remover esta imagem.');
  		}
  		button.prop('disabled', false);
  	});
  });

  uploadAttachment = function(attachment) 
  {
    let file, id, form, key, xhr;

    file = attachment.file;
    form = new FormData;

    form.append("Content-Type", file.type);
    form.append("image", file);

    button.prop('disabled', true);

    xhr = new XMLHttpRequest;
    xhr.open("POST", uploadUrl, true);

    xhr.upload.onprogress = function(event) {
      let progress;
      progress = event.loaded / event.total * 100;

      return attachment.setUploadProgress(progress);
    };
    
    xhr.onload = function(request) {
    	var href, url;
    	button.prop('disabled', false);

    	if (xhr.status === 200) {
    		url = href = xhr.response;

    		return attachment.setAttributes({
    			url: url,
    			href: href
    		});
    	} else {
    		console.log('Não foi possível fazer o upload dessa imagem...');
    	}
    };

    return xhr.send(form);
  };

}).call(this);

</script>
@endpush