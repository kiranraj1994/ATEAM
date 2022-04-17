@extends('layouts.site')
@section('metaTitle','404 Page Note Found')
@section('metaKey', '404 Page Note Found')
@section('metaDescription', '404 Page Note Found')
@section('canonicalUrl', '404 Page Note Found')
@section('content')

    <div class="row gimage"></div>
    <div class="row bg-white">
	    <div class="container">
            <div class="row mb50">
                <div class="col-12 text-center">
                    <div class="abpage">
                        <h2 class="text-center" style="text-align: center;margin-top:5%;"><span><img src="{{URL::asset('front/img/Error.gif')}}" alt=""> 404 &amp;</span> Page Not Found</h2>
                        <a class="btn btn-primary btn-rouned btn-sm" href="{{ url('/') }}">Go To Home</a>
                    </div>
                </div>  
                
            </div>
	    </div>
    </div>
@endsection