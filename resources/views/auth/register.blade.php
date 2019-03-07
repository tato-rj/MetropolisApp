@extends('layouts.raw')

@section('content')
<section class="container-fluid">
    <div class="row" style="min-height: 100vh;">
        <div class="col-lg-6 col-md-6 col-12">
            <a href="{{in_array(url()->previous(), [route('register'), route('login')]) ? '/' : url()->previous()}}" class="btn-back-thin"></a>
            <div class="d-flex flex-center h-100">
                <div class="row">
                    <div class="col-12 mb-2 text-center">
                        <img src="{{asset('images/brand/logo.svg')}}" width="100" class="mb-3">
                        <p class="lead-lg">NOVO CADASTRO</p>
                    </div>

                    @include('auth.register-form')

                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12 d-none d-sm-block">
            <div class="w-100 h-100 bg-align-center" style="background-image: url({{asset('images/footer.jpg')}})">
                <div class="overlay-darkest"></div>
                <div class="d-flex w-100 h-100 align-items-center text-white">
                    <div class="z-10">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script type="text/javascript">
$('input[name="phone"]').inputmask("(21) 99999-9999");
</script>
@endpush
