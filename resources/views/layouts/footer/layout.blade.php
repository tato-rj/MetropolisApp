<section>
  <div class="row no-gutters d-none d-md-flex">
    <div class="position-relative col-lg-6 col-md-12 py-8 bg-align-center" style="background-image: url({{asset('images/footer.jpg')}})">
      <div class="overlay-darkest"></div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-md-10 mx-auto">
            <div class="mb-5 text-light">
              <img src="{{asset('images/brand/logo.svg')}}" width="60">
            </div>

            <div class="mb-5 text-light">
              <div class="mb-3">
                <p class="mb-1"><strong>Endereço</strong></p>
                <p class="mb-1">Av. Rio Branco, nº 151 Grupo 401</p>
                <p class="mb-1">Centro, Rio de Janeiro/RJ</p>
                <p class="m-0">CEP: 20.040-006</p>
              </div>
              <div class="mb-3">
                <p class="mb-1"><strong>Telefone</strong></p>
                <div class="mb-1">
                  <a href="{{formatPhoneLink('whatsapp', '(21) 999-498-498')}}" class="mb-1 link-none"><i class="fab fa-whatsapp fa-lg mr-2"></i>(21) 999-498-498</a>
                </div>
                <div>
                  <a href="{{formatPhoneLink('phone', '(21) 3199-1377')}}" class="m-0 link-none"><i class="fas fa-phone mr-2"></i>(21) 3199-1377</a>
                </div>
              </div>
              <div class="mb-3">
                <p class="mb-1"><strong>Email</strong></p>
                <a href="mailto:contato@metropolisrio.com.br" class="link-none">contato@metropolisrio.com.br</a>
              </div>
              <div class="mb-3">
                <p class="mb-1"><strong>Suporte</strong></p>
                <a href="{{route('terms')}}" class="link-none">Termos & Condições</a>
              </div>
            </div>

            <div class="text-light">
              <a class="link-none p-2" href="#"><i class="fab fa-facebook-f"></i></a>
              <a class="link-none p-2" href="#"><i class="fab fa-instagram"></i></a>
              <a class="link-none p-2" href="#"><i class="fab fa-twitter"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-lg-6 d-none d-lg-block bg-light">
      @include('layouts.footer.map')
    </div>

  </div>
  <div class="bg-dark text-grey text-center p-2">
    <small>Copyright © 2018 Todos os direitos reservados.</small>
  </div>
</section>
