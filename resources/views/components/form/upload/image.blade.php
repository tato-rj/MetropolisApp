<div class="form-group">
  <div id="upload-box">
    <input required type="file" data-target="#image" id="image-input" name="cover_image" style="display:none;" />
    <input type="hidden" name="cropped_width">
    <input type="hidden" name="cropped_height">
    <input type="hidden" name="cropped_x">
    <input type="hidden" name="cropped_y">
    <div class="position-relative image-container">
      <div class="bg-light px-2 text-muted border-left border-top border-right">
        <small><strong><i class="fas fa-image mr-2"></i>Imagem principal</strong></small>
      </div>
      <img class="w-100 border" id="image" src="{{asset('images/covers/placeholder-image.png')}}">
      <div class="controls d-apart mt-3">
        <button type="button" id="upload-button" class="btn btn-red">
          <i class="fas fa-folder-open mr-2"></i>Escolher a foto
        </button>

        <button type="button" id="confirm-button" style="display: none;" class="btn btn-green">
          <i class="fas fa-check-circle mr-2"></i>Confirmar seleção
        </button>

        <button type="button" id="cancel-button" style="display: none;" class="btn btn-red">
          <i class="fas fa-times-circle mr-2"></i>Cancelar
        </button>
      </div>
    </div>
  </div>
    
  @if ($errors->has('image'))
  <div class="invalid-feedback">
    {{ $errors->first('image') }}
  </div>
  @endif
</div>