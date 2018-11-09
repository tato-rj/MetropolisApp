<div class="col-lg-4 col-md-6 col-sm-10 col-12 mx-auto my-3">
  <div class="card border-0 shadow-light">
    <div class="card-header bg-{{$color}} text-white border-0 text-center p-2">
      <label class="m-0"><strong>{{$title}}</strong></label>
    </div>
    <div class="bg-{{$color}}-light text-white text-center py-3">
      <div class="">
        <span class="display-2 price" data-label="/{{$period}}"><strong>{{$price}}</strong></span>
      </div>
    </div>
    <div class="card-body">
{{--       <div class="text-center" style="margin-top: -37px">
        <div class="border-pill px-3 py-1 bg-white border-{{$color}}-light d-inline-block border text-{{$color}}"><small><strong>desconto de {{$discount}}%</strong></small></div>
      </div>      --}}       
      <div class="p-3 text-muted">
        {{$slot}}
      </div>
      <a href="/planos/{{$plan}}/assinar" class="btn btn-{{$color}} btn-block"><strong>Assinar</strong></a>
    </div>
  </div>
</div>