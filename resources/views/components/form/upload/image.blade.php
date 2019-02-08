<div class="form-group mb-0">
  <div id="upload-box">
    <input required type="file" data-target="#image" id="image-input" name="{{$name}}" style="display:none;" />

    <div class="position-relative image-container">
      @if($empty)
      <div class="bg-light px-2 text-muted border-left border-top border-right">
        <small><strong><i class="fas fa-image mr-2"></i>Imagem principal</strong></small>
      </div>
      @endif

      <img class="w-100 border" id="image" src="{{$image}}">
      
      <div class="controls d-apart mt-3">
        <button type="button" id="upload-button" class="btn btn-red">
          <i class="fas fa-folder-open mr-2"></i>{{$empty ? 'Escolher foto' : 'Mudar a foto'}}
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
    
  @if ($errors->has($name))
  <div class="invalid-feedback">
    {{ $errors->first($name) }}
  </div>
  @endif
</div>