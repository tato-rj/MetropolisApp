    <div class="card">
        <div class="card-body mb-0 pb-3">
            <h4 class="card-title">Ranking dos Workshop</h4>
			<h6 class="card-subtitle">Ordenado por total de reservas</h6>
        </div>

        <div class="listview listview--hover">

            @foreach($ranking as $workshop)
            <a class="listview__item">
                <h2 class="mb-0 text-teal mr-3">{{$loop->iteration}}</h2>

                <div class="listview__content">
                    <div class="listview__heading text-truncate">{{$workshop->name}}</div>
                    <p>Número de reservas: {{$workshop->attendees_count}}</p>
                </div>
            </a>
            @endforeach

            <a href="" class="view-more">Ver todos</a>
        </div>
    </div>