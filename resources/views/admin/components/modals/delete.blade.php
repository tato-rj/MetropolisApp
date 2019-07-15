@if($showButton)
@include('admin.components.buttons.delete')
@endif

<div class="modal fade" id="delete-confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tem certeza?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="mb-2">
          {{$message}}
        </p>
        <small class="text-danger mb-3 d-block"><i class="fas fa-exclamation-triangle mr-2"></i>Esta ação não pode ser corrigida</small>
        <div class="text-right">
          <form action="{{$url ?? null}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-red">Sim, pode confirmar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>