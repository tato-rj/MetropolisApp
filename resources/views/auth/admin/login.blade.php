@extends('layouts.raw')

@section('content')
<section class="container-fluid">
    <div class="row" style="min-height: 100vh;">
        <div class="col-lg-6 col-md-6 col-12 mx-auto">
            <div class="d-flex flex-center h-100">
                <div class="row">
                    <div class="col-12 mb-2 text-center">
                        <img src="{{asset('images/brand/logo.svg')}}" width="100" class="mb-3">
                        <p class="lead-lg">ÁREA ADMINISTRATIVA</p>
                    </div>

                    @include('auth.admin.login-form')
               
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
