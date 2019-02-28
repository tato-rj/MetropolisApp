@extends('layouts.raw')

@push('header')
<style type="text/css">
.page_404{
    background:#fff; font-family: 'Arvo', serif;
    margin-bottom: -60px;
    overflow: hidden;
}

.four_zero_four_bg{
    background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
    height: 420px;
    margin: 0 auto;
    background-position: center;
 }
 
 
 .four_zero_four_bg h1{
 font-size:80px;
 }
 
  .four_zero_four_bg h3{
             font-size:80px;
             }
             
             .link_404{          
    color: #fff!important;
    padding: 10px 20px;
    background: #39ac31;
    margin: 20px 0;
    display: inline-block;}
    .contant_box_404{ margin-top:-50px;}
</style>
@endpush

@section('content')
<section class="container-fluid">
    <div class="row pt-5">
        <div class="col-lg-6 col-md-8 col-12 mx-auto text-center">
            <img src="{{asset('images/brand/logo.svg')}}" width="90">
            <div class="page_404 w-100">
                <div class="text-center">
                    <div class="four_zero_four_bg"></div>
                </div>
            </div>
            <h1 class="text-teal mb-3" style="font-size: 6rem"><strong>
            
                @yield('code')
            
            </strong></h1>
            <h4 class="mb-4 text-muted">

                @yield('message')
            
            </h4>

            @yield('action')

        </div>
    </div>
</section>

@endsection
