<li class="nav-item mb-3">
    @if(!empty($icon))
        <span class="{{checkActive($routes, 'text-teal')}} cursor-pointer nav-icon"><i class="fas fa-{{$icon}}"></i></span>
    @else
    <a href="" data-toggle="collapse" data-target="#{{$collapseId}}-menu" class="link-none">
        <span class="{{checkActive($routes, 'text-teal')}}">{{$label}} &#9662;</span>
    </a>
    <div id="{{$collapseId}}-menu" class="collapse {{checkActive($routes, 'show')}}" data-parent="#menu-list">
        @foreach($routes as $route)
        <a href="{{route($route)}}" class="d-block link-none">
            <span class="{{checkActive([$route], 'text-teal')}}">{{$subLabels[$loop->index]}}</span>
        </a>
        @endforeach
    </div>
    @endif
</li>