@extends('layouts.app')
@section('content')
    <section class="login-form page-section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2>{{trans('header.login-title')}}</h2>
                        <div class="separator"></div>
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="gray-form clearfix">
                            <div class="form-group">
                                <label for="email">{{ trans('auth.email') }}</label>
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror" name="email"
                                       value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">{{ trans('auth.password') }}</label>
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="remember-checkbox mb-4">
                                    <input type="checkbox" name="remember"
                                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember">
                                        {{ trans('auth.remember') }}
                                    </label>
                                    @if (Route::has('password.request'))
                                        <a class="float-right" href="{{ route('password.request') }}">
                                            {{ trans('auth.forgot') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="button red">
                                {{ trans('auth.login') }}
                            </button>
                            <div class="mt-3 text-center">
                                <a href="{{url('register')}}" class="button red">{{trans('auth.register')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
