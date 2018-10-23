@extends('layouts.raw')

@section('content')
<section class="container-fluid">
    <div class="row" style="min-height: 100vh;">
        <div class="col-lg-6 col-md-6 col-12">
            <a href="/" class="btn-back-thin"></a>
            <div class="d-flex flex-center h-100">
                <div class="row">
                    <div class="col-12 mb-2 text-center">
                        <img src="{{asset('images/logo.svg')}}" width="100" class="mb-3">
                        <p class="lead-lg">CONFIRME O SEU EMAIL</p>
                    </div>

                    <div class="col-default text-center">
                        @if (session('resent'))
                            @include('components.alerts.success', ['message' => 'Um novo email de confirmação acabou de ser enviado!'])
                        @else
                            <p class="mb-4">Antes de prosseguir, por favor <strong>confirme o seu email</strong>.</p>
                        @endif
                        
                        <div class="bg-light p-3">
                            <p>Não recebeu o nosso email de confirmação?</p>
                            <p class="m-0"><a href="{{ route('verification.resend') }}" class="link-blue">Clique aqui</a> para receber outro.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12 d-none d-sm-block">
            <div class="w-100 h-100 bg-align-center" style="background-image: url({{asset('images/footer.jpg')}})">
                <div class="overlay-darkest"></div>
                <div class="d-flex w-100 h-100 align-items-center text-white">
                    <div class="z-10"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 --}}