@extends('layouts.front.base')
@section('title', 'login')
@section('css')
    <link href="{{ asset('assets/css/pages/login/classic/login-3.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="login login-3 login-signin-on d-flex flex-row-fluid" id="kt_login">
        <div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid"
            style="background-image: url(assets/media/bg/bg-1.jpg);">
            <div class="login-form text-center text-white p-7 position-relative overflow-hidden">
                <!--begin::Login Header-->
                <div class="d-flex flex-center mb-15">
                    <a href="#">
                        <img src="assets/media/logos/logo-letter-9.png" class="max-h-100px" alt="" />
                    </a>
                </div>
                <!--end::Login Header-->
                <!--begin::Login Sign in form-->
                <div class="login-signin">
                    <div class="mb-20">
                        <h3>Sign In To Admin</h3>
                        <p class="opacity-60 font-weight-bold">Enter your details to login to your account:</p>
                    </div>
                    <form class="form" id="kt_login_signin_form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input id="email" type="email"
                                class="form-control h-auto text-white placeholder-white opacity-70 bg-dark-o-70 rounded-pill border-0 py-4 px-8 mb-5 @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter Email Address" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input id="password" type="password"
                                class="form-control h-auto text-white placeholder-white opacity-70 bg-dark-o-70 rounded-pill border-0 py-4 px-8 mb-5 @error('password') is-invalid @enderror"
                                name="password" required autocomplete="current-password" placeholder="Enter Password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-group d-flex flex-wrap justify-content-between align-items-center px-8">
                            <div class="checkbox-inline">
                                <label class="checkbox checkbox-outline checkbox-white text-white m-0">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span></span>Remember me</label>
                            </div>

                        </div>
                        <div class="form-group text-center mt-10">
                            <button id="kt_login_signin_submit"
                                class="btn btn-pill btn-outline-white font-weight-bold opacity-90 px-15 py-3">Sign
                                In</button>
                        </div>
                    </form>

                </div>
                <!--end::Login Sign in form-->
                <!--begin::Login Sign up form-->

                <!--end::Login Sign up form-->
                <!--begin::Login forgot password form-->
            
                <!--end::Login forgot password form-->
            </div>
        </div>
    </div>
    <!--end::Login-->
@endsection
