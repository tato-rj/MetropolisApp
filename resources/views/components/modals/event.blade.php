<div class="modal fade" id="event-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Informações sobre a reserva</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
          
        </div>
        <div id="loading">
          <div class="p-4 d-flex justify-content-center align-items-center">
            <span class="text-muted"><i>Carregando...</i></span>
          </div>
        </div>
      </div>
      <div class="modal-footer border-0 bg-light" style="display: none;">
        <div class="d-flex align-items-center justify-content-between w-100">
          <span class="text-muted"><strong>Re-enviar os emails de convite?</strong></span>
          <form method="POST" action="{{route('client.events.invite')}}">
            @csrf
            <input type="hidden" name="event_id">
            <button type="submit" class="btn btn-xs btn-teal"><i class="fas fa-envelope mr-2"></i><strong>Sim!</strong></button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>