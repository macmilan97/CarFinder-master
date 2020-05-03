@extends('layouts.app')
@section('content')
    <section class="register-form page-section-ptb">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="section-title">
                        <h2>{{ trans('auth.register') }}</h2>
                        <div class="separator"></div>
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('register') }}" class="entrance__form gray-form">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-12">
                        <div class="gray-form">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="last_name">{{ trans('auth.last-name') }}</label>
                                    <input id="last_name" autofocus required autocomplete="last_name"
                                           value="{{ old('last_name') }}"
                                           class="form-control placeholder @error('last_name') is-invalid @enderror"
                                           type="text" name="last_name">
                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="first_name">{{ trans('auth.first-name') }}</label>
                                    <input id="first_name"  required autocomplete="first_name"
                                           value="{{ old('first_name') }}"
                                           class="form-control placeholder @error('first_name') is-invalid @enderror"
                                           type="text" name="first_name">
                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone">{{trans('auth.phone')}}</label>
                                <input id="phone" required autocomplete="phone"
                                       value="{{ old('phone') }}"
                                       class="form-control placeholder txtLogin @error('phone') is-invalid @enderror"
                                       type="text" name="phone">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">{{trans('auth.email')}}</label>
                                <input id="email" required autocomplete="email"
                                       value="{{ old('email') }}"
                                       class="form-control placeholder @error('email') is-invalid @enderror"
                                       type="email" name="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">{{trans('auth.password')}} </label>
                                <input id="password" required autocomplete="password"
                                       value="{{ old('password') }}"
                                       class="form-control placeholder @error('password') is-invalid @enderror"
                                       type="password" name="password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password-confirm">{{trans('auth.confirm-pass')}} </label>
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <div class="form-group">
                                <label for="city">{{trans('auth.city')}}</label>
                                <select id="city" class="form-control" name="city_id">
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="remember-checkbox">
                                <input type="checkbox" name="accept" id="one" required>
                                <label for="one">{!!trans('auth.accept')!!}</label>
                            </div>
                        </div>
                        <button type="submit" class="button red">{{trans('auth.register')}}</button>
                        <p class="link">{{trans('auth.already')}} <a href="{{url('login')}}">{{trans('auth.login')}}</a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
