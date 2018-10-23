<div class="col-lg-4 col-md-6 col-sm-10 col-12 mx-auto my-3">
  <div class="card border-0 shadow-light">
    <div class="card-header bg-{{$color}} text-white border-0 text-center p-2">
      <label class="m-0"><strong>{{$title}}</strong></label>
    </div>
    <div class="bg-{{$color}}-light text-white text-center pb-3">
      <div class="position-relative d-inline-block">
        <h5 class="absolute-top-left" style="left: -1.35em"><strong>R$</strong></h5>
        <span class="display-2"><strong>{{$price}}</strong></span>
        <span class="absolute-bottom-right" style="right: -2.15em">/mês</span>
      </div>
    </div>
    <div class="card-body">
      <div class="text-center" style="margin-top: -37px">
        <div class="border-pill px-3 py-1 bg-white border-{{$color}}-light d-inline-block border text-{{$color}}"><small><strong>desconto de {{$discount}}%</strong></small></div>
      </div>            
      <div class="p-3 text-muted">
        {{$slot}}
      </div>
      <a href="#" class="btn btn-{{$color}} btn-block"><strong>Assinar</strong></a>
    </div>
  </div>
</div>