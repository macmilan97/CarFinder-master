@extends('layouts.app')
@section('content')
    <section class="register-form page-section-ptb">
        <div class="container">
            <form method="POST" action="{{ route('profile-save') }}" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-12">
                        <div class="gray-form">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="first_name">{{ trans('auth.first-name') }}</label>
                                    <input id="first_name" autofocus required autocomplete="first_name"
                                           value="{{ Auth::user()->first_name }}"
                                           class="form-control placeholder @error('first_name') is-invalid @enderror"
                                           type="text" name="first_name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="last_name">{{ trans('auth.last-name') }}</label>
                                    <input id="last_name" required autocomplete="last_name"
                                           value="{{ Auth::user()->last_name }}"
                                           class="form-control placeholder @error('last_name') is-invalid @enderror"
                                           type="text" name="last_name">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="avatar">{{ trans('profile.avatar') }}</label>
                                <input id="avatar"
                                       class="form-control placeholder @error('avatar') is-invalid @enderror"
                                       type="file" name="avatar" accept="image/*">
                            </div>
                            <div class="form-group ">
                                <label for="departure">{{ trans('profile.departure') }}</label>
                                <select id="departure" class="form-control" name="departure">
                                    <option value="1" {{(isset(Auth::user()->profile->departure) and Auth::user()->profile->departure == 1) ? 'selected' : '' }}>{{trans('profile.yes')}}</option>
                                    <option value="0" {{(isset(Auth::user()->profile->departure) and Auth::user()->profile->departure == 0) ? 'selected' : '' }}>{{trans('profile.no')}}</option>
                                </select>
                            </div>
                            <div class="form-group ">
                                <label for="experience">{{ trans('profile.experience') }}</label>
                                @if(isset(Auth::user()->profile->experience))
                                    <input id="experience" value="{{Auth::user()->profile->experience}}"
                                           class="form-control placeholder @error('experience') is-invalid @enderror"
                                           type="number" name="experience">
                                @else
                                    <input id="experience" value="1"
                                           class="form-control placeholder @error('experience') is-invalid @enderror"
                                           type="number" name="experience">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="city">{{trans('auth.city')}}</label>
                                <select id="city" class="form-control" name="city_id">
                                    @foreach($cities as $city)
                                        @if($city->id == Auth::user()->city_id)
                                            <option value="{{$city->id}}"
                                                    selected>{{ Auth::user()->city->title}}</option>
                                        @else
                                            <option value="{{$city->id}}">{{ $city->title}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="button red">{{trans('profile.save')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
