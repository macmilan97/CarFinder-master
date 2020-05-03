@extends('layouts.app')

@section('content')
    <section class="login-form page-section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2>{{ trans('auth.reset-password') }}</h2>
                        <div class="separator"></div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-12">
                    <div class="gray-form clearfix">
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                        <div class="form-group">
                            <label for="name">{{ __('E-Mail') }}* </label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                            <button type="submit" class="button red">
                                {{ trans('auth.reset-btn') }}
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
