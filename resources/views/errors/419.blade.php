@extends('layouts.raw')

@push('header')
<style type="text/css">
.page_404{ padding:40px 0; background:#fff; font-family: 'Arvo', serif;
}

.page_404  img{ width:100%;}

.four_zero_four_bg{
 
 background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
    height: 400px;
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
    <div class="row" style="min-height: 100vh;">
        <div class="col-lg-6 col-md-6 col-12 d-flex flex-center">
            <div class="px-6">
                <h1 class="text-teal mb-4" style="font-size: 6rem"><strong>419</strong></h1>
                <h4 class="mb-4 text-muted">Parece que a sua sessão expirou. Pode tentar novamente, ou contacte o nosso escritório se este problema persistir.</h4>
                <a href="{{route('welcome')}}" class="btn btn-red">Voltar para página principal</a>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12 d-none d-sm-block">

        	<section class="page_404 h-100">
				<div class="text-center h-100">
					<div class="four_zero_four_bg h-100"></div>
				</div>
        	</section>
        </div>
    </div>
</section>

@endsection
