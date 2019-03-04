<div class="col-lg-4 col-md-6 col-sm-10 col-12 mx-auto my-3">
  <div class="card border-0 shadow-light">
    <div class="card-header bg-{{$plan->color}} text-white border-0 text-center p-2">
      <label class="m-0 text-uppercase"><strong>{{$plan->name}}</strong></label>
    </div>
    <div class="bg-{{$plan->color}}-light text-white text-center py-3">
      <div class="">
        <span class="display-2 price" data-label="/{{$plan->cycle()}}"><strong>{{fromCents($plan->fee)}}</strong></span>
      </div>
    </div>
    <div class="card-body">
      <div class="p-3 text-muted">
        @include('components.plans.icons.'.str_slug($plan->type))
      </div>
      <a href="{{route('plan.confirm', ['plan_id' => $plan->id])}}" class="btn btn-{{$plan->color}} btn-block">Assinar</a>
    </div>
  </div>
</div>