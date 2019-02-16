    <div class="card border-0 shadow-sm">
        <div class="card-body mb-0 pb-3">
            <h5 class="mb-1">Ranking dos Workshops</h5>
			<p class="m-0">Ordenado por total de reservas</p>
        </div>

        <div class="list-group list-group-flush">
            @forelse($ranking as $workshop)
            <div class="d-flex align-items-center list-group-item list-group-item-action border-0">
                <h2 class="text-teal mr-3"><strong>{{$loop->iteration}}</strong></h2>
                <div style="width: 86%">
                    <h6 class="m-0 text-truncate">
                        <a href="#" class="link-none">{{$workshop->name}}</a>
                    </h6>
                    <p class="m-0"><small>Número de reservas: {{$workshop->attendees_count}}</small></p>
                </div>
            </div>
            @empty
            <div class="d-flex flex-center" style="height: 300px">
                <p class="text-muted"><i>Nenhum workshop foi criado</i></p>
            </div>
            @endforelse
        </div>
    </div>