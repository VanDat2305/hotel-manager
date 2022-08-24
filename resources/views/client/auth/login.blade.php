@extends('client.auth.app')
@section('title')
    {{ __($title) }}
@endsection
@section('content')
    <section class="login-area padding-top-100 padding-bottom-100">
        <div class="container">
            <div class="login-wrapper login-shadow bg-white">
                <div class="login-wrapper-flex">
                    <div class="login-wrapper">
                        <img src="{{ asset('bower_components/template-hotel-booking/beyond_hotel/assets/img/single-page/login.jpg') }}"
                            width="550rem" alt="img">
                    </div>
                    <div class="login-wrapper-contents login-padding">
                        <h2 class="single-title"> {{ __('Welcome') }} </h2>
                        <form class="login-wrapper-contents-form custom-form" action="{{ route('postLogin') }}"
                            method="post">
                            @csrf
                            <div class="single-input mt-4">
                                <label class="label-title mb-3"> {{ __('Email') }} </label>
                                <input class="form-control @error('email') is-invalid @enderror" type="text"
                                    name="email" placeholder="{{ __('Enter email') }}" value="{{isset($email)?$email:old('email')}}">
                            </div>
                            @error('email')
                                <div class="text-danger p-1">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="single-input mt-4">
                                <label class="label-title mb-3"> {{ __('PASSWORD') }} </label>
                                <input class="form-control " type="password" name="password" 
                                    placeholder="{{ __('Enter password') }}" value="{{isset($password)?$password:old('password')}}">
                                <div class="icon toggle-password">
                                    <div class="show-icon"> <i class="las la-eye-slash"></i> </div>
                                    <span class="hide-icon"> <i class="las la-eye"></i> </span>
                                </div>
                            </div>
                            @error('password')
                                <div class="text-danger p-1">
                                    {{ $message }}
                                </div>
                            @enderror
                            <button class="submit-btn w-100 mt-4" type="submit"> {{ __('SignIn') }} </button>
                            <span class="account color-light mt-3">{{ __('Do not have an account') }} <a class="color-one"
                                    href="{{ route('register') }}"> {{ __('SignUp') }} </a> </span>
                        <div class="single-checkbox mt-3">
                            <div class="checkbox-inline">
                                <input class="check-input" name="remember" type="checkbox" id="check15" {{isset($email) ? "checked" : ""}} >
                                <label class="checkbox-label" for="check15"> {{ __('Remember Me') }} </label>
                            </div>
                            <div class="forgot-password">
                                <a href="forgot_password.html" class="forgot-btn color-one"> {{ __('Forgot Password') }}
                                </a>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
