<div class="modal fade" id="modal-{{$type}}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content rounded-0">
      <div class="modal-header border-0 rounded-0 bg-grey-lighter text-dark">
        <h5 class="modal-title"><strong>{{$title}}</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-12 mb-4-sm">
            <div class="w-100 mb-2" style="height: 250px">
              <div class="bg-align-center w-100 h-100 cover" style="background-image: url({{asset("images/{$type}/{$type}-1.jpg")}})"></div>
            </div>
            <div class="d-flex flex-wrap" style="margin: -0.25rem;">
              @for($i=1; $i<=$count; $i++)
              <div class="w-25 p-1" style="height: 80px">
                <div class="bg-align-center cursor-pointer w-100 h-100 thumb {{$i > 1 ? 'hover-grayscale-out' : null}}" data-modal="#modal-{{$type}}" style="background-image: url({{asset("images/{$type}/{$type}-{$i}.jpg")}});"></div>
              </div>
              @endfor
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-12">
            <div>
              {{$slot}}
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row align-items-center py-3">
        <div class="col-lg-6 col-md-6 col-12">
          <span class="mx-2">Tem alguma dúvida? <a href="/contato" class="link-teal">Clique aqui</a></span>
        </div>        
        <div class="col-lg-6 col-md-6 col-12">
          <form method="GET" action="/procurar">
            <input type="hidden" name="space" value="{{$type}}">
            <input type="hidden" name="date" value="{{now()->format('Y-m-d')}}">
            <input type="hidden" name="time" value="8">
            <input type="hidden" name="participants" value="1">
            <input type="hidden" name="duration" value="8">
            <input type="hidden" name="search" value="true">
           <button class="btn btn-block btn-red rounded-0"><strong>Solicitar uma reserva</strong></button>
          </form>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>