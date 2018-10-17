<section class="container mb-8">
  <div class="row align-items-center">
    <div class="col-lg-6 col-md-10 col-sm-10 col-12 mx-auto">
      <div class="video-btn-wrapper mb-4 position-relative cursor-pointer">
        <video id="video" class="w-100 rounded shadow-center" poster="{{asset('images/video-cover.jpg')}}">
          <source src="{{asset('videos/escritorio.mp4')}}" type="video/mp4">
        </video>
        <div id="play-button" class="absolute-center bg-red text-white rounded px-4 py-2"><i class="fas fa-play fa-1x"></i></div>
      </div>
    </div>

    <div class="col-lg-6 col-12">
      <ol class="step p-0">
        <li class="step-item">
          <div class="step-icon">
            <span class="iconbox">1</span>
          </div>

          <div class="step-content">
            <p><strong>Marque o dia e o horário</strong></p>
            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
          </div>
        </li>

        <li class="step-item">
          <div class="step-icon">
            <span class="iconbox">2</span>
          </div>

          <div class="step-content">
            <p><strong>Escolha o espaço</strong></p>
            <p class="text-muted">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
          </div>
        </li>

        <li class="step-item">
          <div class="step-icon">
            <span class="iconbox">3</span>
          </div>

          <div class="step-content">
            <p><strong>Comece a trabalhar!</strong></p>
            <p class="text-muted">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris commodo consequat.</p>
          </div>
        </li>
      </ol>
    </div>
  </div>
</section>