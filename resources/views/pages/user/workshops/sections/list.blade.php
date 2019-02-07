<section class="container mb-6">
  <div class="row">
    <div class="col-default mb-5 pr-0 border-bottom">
      @include('pages.workshops.sections.filters')
    </div>
  </div>
  <div class="row">
    <div class="col-default mb-4">
      @forelse($workshops as $workshop)
      @include('pages.workshops.sections.event')
      @empty
      <div class="text-center py-6">
        <p class="text-muted mb-4"><i>Você ainda não fez nenhuma reserva</i></p>
        <a href="{{route('workshops.index')}}" class="btn btn-red">Participe de um dos nossos Workshops</a>
      </div>
      @endforelse
    </div>
    <div class="col-default d-flex justify-content-center">
      {{ $workshops->links() }}
    </div>
  </div>
</section>