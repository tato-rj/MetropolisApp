<div class="modal fade" id="new-event-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nova reserva</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('admin.schedule.store')}}">
          @csrf

          <div class="form-group">
            <select required class="form-control" name="space_id">
              <option selected disabled>Escolha o espaço</option>
              @foreach($spaces as $space)
              <option value="{{$space->id}}" {{old('space_id') == $space->id ? 'selected' : null}}>{{$space->name}}</option>
              @endforeach
            </select>
            @include('components/form/error', ['bag' => 'default', 'field' => 'space_id'])
          </div>

          <div class="form-group">
            @include('components.calendar.input', ['blank' => true])
            @include('components/form/error', ['bag' => 'default', 'field' => 'date'])
          </div>
          
          <div class="form-group">
            <select required name="time" class="form-control">
              <option selected disabled>Horário</option>
              @for($i = office()->day_starts_at; $i <= office()->day_ends_at; $i++)
              <option value="{{$i}}">{{$i}}:00h</option>
              @endfor
            </select>
          </div>
          
          <div class="form-group">
            <select required name="duration" class="form-control">
              <option selected disabled>Duração</option>
              <option value="1">1 hora</option>
              <option value="2">2 horas</option>
              <option value="4">4 horas</option>
              <option value="6">6 horas</option>
              <option value="{{office()->day_length}}">Dia inteiro</option>
            </select>            
          </div>

          <div class="form-group">
            @foreach($spaces as $space)
            <select required 
              name="{{$loop->first ? 'participants' : null}}" 
              id="select-participants-{{$space->slug}}" 
              class="participants form-control"
              style="{{! $loop->first ? 'display: none' : null}}">
              <option selected disabled>Número de participantes</option>
              @for($i = 1; $i <= $space->capacity; $i++)
              <option value="{{$i}}">{{$i .' '. trans_choice('words.pessoas', $i)}}</option>
              @endfor
            </select>
            @endforeach
            @include('components/form/error', ['bag' => 'default', 'field' => 'participants'])
          </div>
          <div class="text-right">
            <button type="submit" class="btn btn-red">Confirmar evento</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>