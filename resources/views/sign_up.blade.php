@extends('layouts.site')
@section('metaTitle')
@section('metaKey')
@section('metaDescription')
@section('canonicalUrl')
@section('content')


<div class="row mb20">
    <div id="login-box">
        <div class="right col-md-12">
            <h1 class="text-center">Sign Up</h1>
            
            <form method="post" action="{{route('user.register')}}">
                @csrf

                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" name="name" id="name" placeholder="Full Name*" >
                @error('name')
                    <p class="text-danger text-left">{{ $message }}</p>
                @enderror

                <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" name="email" id="email" placeholder="E-mail Id*" >
                @error('email')
                    <p class="text-danger text-left">{{ $message }}</p>
                @enderror
               
                <div class="mt20">
                    <input type="radio" class=" @error('gender') is-invalid @enderror" name="gender" value="{{old('gender','male')}}"  id="gender" checked>Male
                    <input type="radio" class=" @error('gender') is-invalid @enderror" name="gender" value="{{old('gender','female')}}"  id="gender">Female
                    @error('gender')
                        <p class="text-danger text-left">{{ $message }}</p>
                    @enderror
                </div>

                <input type="text" class="form-control @error('dob') is-invalid @enderror" value="{{old('dob')}}" name="dob" id="dob" placeholder="Dob*" >
                @error('dob')
                    <p class="text-danger text-left">{{ $message }}</p>
                @enderror
                

                <input  type="password"   autocomplete="new-password"  class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password*">
                @error('password')
                    <p class="text-danger text-left">{{ $message }}</p>
                @enderror
                

                <input  type="password"   autocomplete="new-password"  class="form-control @error('confirmPassword') is-invalid @enderror" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password*">
                @error('confirmPassword')
                    <p class="text-danger text-left">{{ $message }}</p>
                @enderror

                <input type="submit" class="form-control" name="signup_submit" value="Sign Up">

                @if ($message = Session::get('error'))
                    <p class="text-danger text-left">{{ $message }}</p>
                @endif
            </form>
            
            <p><br>Already have an account? <a href="{{url('login')}}">Login Now</a></p>
            
          </div>
    </div>


@endsection