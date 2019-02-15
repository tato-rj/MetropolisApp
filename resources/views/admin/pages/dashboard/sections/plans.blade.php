<div class="card border-0 shadow-sm">
    <div class="row no-gutters">
        <div class="col-12 alert-red alert-accent-top font-weight-bold p-2 text-center">Total de {{$memberships_count}} {{str_plural('assinatura', $memberships_count)}}</div>
        @foreach($plans as $plan)
        <div class="col-6 col-sm-4 col-md-6 col-lg-4 text-white text-center py-4 {{$loop->iteration % 2 == 0 ? 'bg-red' : 'bg-red-light'}}">
            <div class="text-center">
                <h4 class="text-percentage m-0">{{percentage($plan->memberships_count, $membershipsCount)}}</h4>
                <span style="width: 25%; height: 2px; background-color: rgba(255,255,255,0.5); display: inline-block; vertical-align: super"></span>
            </div>
            <div>
                <div>{{ucfirst($plan->type)}}</div>
                <div>{{ucfirst($plan->name)}}</div>
            </div>
        </div>
        @endforeach
    </div>
</div>