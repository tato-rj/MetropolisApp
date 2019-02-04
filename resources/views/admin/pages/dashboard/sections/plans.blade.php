	<div class="card"></div>
	<div class="card"></div>

                    <div class="card card--inverse widget-pie">
                        @foreach($plans as $plan)
                        <div class="col-6 col-sm-4 col-md-6 col-lg-4 widget-pie__item">
                            <div class="easy-pie-chart" data-percent="{{percentage($plan->memberships_count, $membershipsCount)}}" data-size="100" data-track-color="rgba(0,0,0,0.08)" data-bar-color="#fff">
                                <span class="easy-pie-chart__value">{{percentage($plan->memberships_count, $membershipsCount)}}</span>
                            </div>
                            <div class="widget-pie__title">{{ucfirst($plan->type)}}<br> {{ucfirst($plan->name)}}</div>
                        </div>
                        @endforeach

                    </div>