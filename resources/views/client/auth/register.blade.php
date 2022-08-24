@extends('client.auth.app')
@section('title')
    {{ __($title) }}
@endsection
@section('content')
    <section class="l-area padding-top-100 padding-bottom-100">
        <div class="container">
            <div class=" login-shadow bg-white">
                <div class="login-wrapper-flex">
                    <div class="login-wrapper-thumb">
                        <img src="{{ asset('bower_components/template-hotel-booking/beyond_hotel/assets/img/single-page/login.jpg') }}"
                            alt="img">
                    </div>
                    <div class="login-wrapper-contents login-padding">
                        <h2 class="single-title"> Welcome! </h2>
                        <form class="login-wrapper-form custom-form padding-top-20" action="{{ route('post.register') }}"
                            method="post">
                            @csrf
                            <div class="input-flex-item">
                                <div class="single-input mt-4">
                                    <label class="label-title mb-3"> {{ __('Firstname') }} </label>
                                    <input class="form--control" type="text" name="firstname"
                                        placeholder="{{ __('Enter firstname') }}" value="{{old('firstname')}}">
                                    @error('firstname')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="single-input mt-4">
                                    <label class="label-title mb-3"> {{ __('Lastname') }} </label>
                                    <input class="form--control" type="text" name="lastname"
                                        placeholder="{{ __('Enter lastname') }}" value="{{old('lastname')}}">
                                    @error('lastname')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="single-input mt-4">
                                <label class="label-title mb-3"> {{ __('Email Address') }} </label>
                                <input class="form--control" type="text" name="email"
                                    placeholder="{{ __('Enter email') }}" value="{{old('email')}}">
                                @error('email')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="single-input mt-4">
                                <label class="label-title mb-3"> {{ __('PHONE') }} </label>
                                <input class="form--control" type="number" name="phone"
                                    placeholder="{{ __('Enter phone') }}" value="{{old('phone')}}">
                                @error('phone')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="single-input mt-4">
                                <label class="label-title mb-3"> {{ __('ADDRESS') }} </label>
                                <input class="form--control" type="text" name="address"
                                    placeholder="{{ __('Enter address') }}" value="{{old('address')}}">
                                @error('address')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="input-flex-item">
                                <div class="single-input mt-4">
                                    <label class="label-title mb-3"> {{ __('PASSWORD') }} </label>
                                    <input class="form--control" type="password" name="password"
                                        placeholder="{{ __('Enter password') }}">
                                    @error('password')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="single-input mt-4">
                                    <label class="label-title mb-3"> {{ __('Confirm Password') }} </label>
                                    <input class="form--control" type="password" name="re-password"
                                        placeholder="{{ __('Enter password') }}">
                                    @error('re-password')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <button class="submit-btn w-100 mt-4" type="submit"> {{ __('SignUp') }} </button>
                            <span class="account color-light mt-3"> {{ __('Already have an account') }} <a
                                    class="color-one" href="{{ route('login') }}"> {{ __('SignIn') }} </a> </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
