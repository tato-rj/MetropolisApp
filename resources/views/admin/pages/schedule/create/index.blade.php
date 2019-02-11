@extends('admin.layouts.app')

@push('header')
<style type="text/css">
.sa-icon.sa-success .sa-fix, .sa-icon.sa-success.animate::after, .sa-icon.sa-success.animate::before {
    background-color: #f8f9fa;
}
</style>
@endpush

@section('content')

<div class="row">
  <div class="col-12 mb-5">
    <div class="row w-100 mx-auto mb-2">

      <div class="col-lg-3 col-12 p-0">
        @include('components.calendar.input')
      </div>
      
      <select name="space_id" class="col-lg-3 col-6 form-control border-left-0 toggle-finder">
        <option selected disabled>Espaço</option>
        @foreach($spaces as $space)
        <option data-target="{{$space->slug}}" value="{{$space->id}}">{{$space->name}}</option>
        @endforeach
      </select>

      @foreach($spaces as $space)
      <select 
        name="{{$loop->first ? 'participants' : null}}" 
        id="select-participants-{{$space->slug}}" 
        class="participants col-lg-2 col-6 form-control border-left-0"
        style="{{! $loop->first ? 'display: none' : null}}">
        <option selected disabled value="">Participantes</option>
        @for($i = 1; $i <= $space->capacity; $i++)
        <option value="{{$i}}">{{$i .' '. trans_choice('words.pessoas', $i)}}</option>
        @endfor
      </select>
      @endforeach

      <select name="time" class="col-lg-2 col-6 form-control border-left-0">
        <option selected disabled value="">Horário</option>
          @for($i = office()->day_starts_at; $i < office()->day_ends_at; $i++)
          <option value="{{$i}}.0">{{$i}}:00h</option>
          @unless($i == office()->day_ends_at -1)
          <option value="{{$i}}.30">{{$i}}:30h</option>
          @endunless
          @endfor
      </select>
      
      <select name="duration" class="col-lg-2 col-6 form-control border-left-0">
        <option selected disabled value="">Duração</option>
        <option value="1">1 hora</option>
        <option value="2">2 horas</option>
        <option value="4">4 horas</option>
        <option value="6">6 horas</option>
        <option value="{{office()->day_length}}">Dia inteiro</option>
      </select>

    </div>

    <div class="text-right">
      <button id="search" class="btn btn-teal"><i class="fas fa-search mr-2"></i>Buscar</button>
    </div>
  </div>
  <div class="col-12">
    <div id="results-box" style="display: none;" class="container"></div>
    <div id="empty-box" class="h-100 text-grey text-center my-5">
      <h1><i class="fas fa-angle-up"></i></h1>
      <h4><i>Escolha os detalhes da reserva acima</i></h4>
    </div>
    <div id="loading-box" class="text-grey text-center my-5" style="display: none;">
      <h2 class="mb-3"><i class="fas fa-hourglass-half"></i></h2>
      <h4><i>Estamos vendo como está a agenda nesse dia...</i></h4>
    </div>
    <div id="fail-box" class="text-grey text-center my-5" style="display: none;">
      <h1 class="mb-2"><i class="far fa-frown"></i></h1>
      <h4><i><span class="feedback"></span></i></h4>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
(new CustomDatePicker('#datepicker')).enableTogglers('.toggle-finder', false).create();
</script>

<script type="text/javascript">

let $loadingBox = $('#loading-box');
let $emptyBox = $('#empty-box');
let $resultsBox = $('#results-box');
let $failBox = $('#fail-box');

let dateInput = 'input[name="date"]';
let spaceInput = 'select[name="space_id"]';
let participantsInput = 'select[name="participants"]';
let timeInput = 'select[name="time"]';
let durationInput = 'select[name="duration"]';
let requestRunning = false;

$('button#search').on('click', function() {
    if (requestRunning)
      return;
    
    requestRunning = true;
    
    showLoading();

    let request = {
      'space_id': getVal(spaceInput),
      'date': getVal(dateInput),
      'time': getVal(timeInput),
      'participants': getVal(participantsInput),
      'duration': getVal(durationInput)
    };

    $.get({!! json_encode(route('admin.schedule.check'), JSON_HEX_TAG) !!}, request, function(data) {

      showResults(data);

      $('input[name="send_emails"]').on('click', function() {
        if ($(this).val() == 'true') {
          $('#emails').fadeIn();
        } else {
          $('#emails').hide();
        }
      });
    }).fail(function(response) {
      console.log(response);

      if (response.status == 422) {
        showFail('Todos os campos são obrigatórios');
      } else {
        showEmpty();
      }
    }).always(function() {
      requestRunning = false;
    });

});

function showLoading() {
  $emptyBox.hide();
  $resultsBox.hide().html('');
  $loadingBox.show();
  $failBox.hide();
}

function showResults(data) {
  $emptyBox.hide();
  $resultsBox.html(data).show();
  $loadingBox.hide();
  $failBox.hide();
  fullDatePT($('.date-pt'));
}

function showEmpty() {
  $emptyBox.show();
  $resultsBox.hide().html('');
  $loadingBox.hide();
  $failBox.hide();
}

function showFail(message) {
  $emptyBox.hide();
  $resultsBox.hide().html('');
  $loadingBox.hide();
  $failBox.find('.feedback').text(message);
  $failBox.show();
}
</script>
<script type="text/javascript">

function getVal(selector) {
  let element = $(selector);

  if (element.is('input'))
    return element.val();

  return element.find('option:selected').val();
}
</script>
@endpush