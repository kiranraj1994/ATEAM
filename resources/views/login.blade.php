@extends('layouts.site')
@section('metaTitle')
@section('metaKey')
@section('metaDescription')
@section('canonicalUrl')
@section('content')


<div class="row mb20">
    <div id="login-box">
        <div class="right col-md-12">
            <h1 class="text-center">Login</h1>
            
            <form method="post" action="{{route('user.login-form')}}">
                @csrf
                <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" name="email" id="email" placeholder="E-mail" >
                @error('email')
                    <p class="text-danger text-left">{{ $message }}</p>
                @enderror
                

                   <input  type="password" value="{{old('password')}}"  autocomplete="new-password"  class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
                @error('password')
                    <p class="text-danger text-left">{{ $message }}</p>
                @enderror

                <input type="submit" class="form-control" name="signup_submit" value="Login">

                @if ($message = Session::get('error'))
                    <p class="text-danger text-left">{{ $message }}</p>
                @endif
            </form>
            
            <p><br>Don't have an account? <a href="{{url('sign-up')}}">Register Now</a></p>
            
          </div>
    </div>


@endsection