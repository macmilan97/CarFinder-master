@extends('layouts.app')
@section('content')
    <section class="inner-intro bg-2 bg-overlay-black-70">
        <div class="container">
            <div class="row text-center intro-title">
                <div class="col-md-6 text-md-left d-inline-block">
                    <h1 class="text-white">{{trans('header.expert')}}</h1>
                </div>
                <div class="col-md-6 text-md-right float-right">
                    <ul class="page-breadcrumb">
                        <li>
                            <a href="{{route('home')}}"><i class="fa fa-home"></i> {{trans('header.home')}}</a>
                            <i class="fa fa-angle-double-right"></i>
                        </li>
                        <li><span>{{trans('header.expert')}}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="latest-blog border masonry-main page-section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row pull-right ">
                        <form method="get" action="{{route('experts')}}">
                        <select class="form-control" name="sort_id" onchange="this.form.submit()">
                            <option disabled selected>{{trans('car.sort.title')}}</option>
                            <option value="1" {{ ($sort_id == '1') ? 'selected' : '' }}>{{trans('car.sort.price.low')}}</option>
                            <option value="2" {{ ($sort_id == '2') ? 'selected' : '' }}>{{trans('car.sort.price.high')}}</option>
                        </select>
                        </form>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="masonry columns-3">
                        <div class="grid-sizer"></div>
                        <div class="row">
                            @foreach($experts as $expert)
                                <div class="col-lg-3 col-md-6">
                                    <div class="team text-center">
                                        <div class="team-image">
                                            @if(isset($expert->profile->image))
                                                <img class="img-fluid"
                                                     src="{{'/storage/'.$expert->profile->image}}" alt="">
                                            @else
                                                <img class="img-fluid"
                                                     src="{{asset('images/profile/default-user.png')}}" alt="">
                                            @endif
                                        </div>
                                        <div class="team-name">
                                            <h5 class="text-black">{{trans('auth.first-name')}}
                                                : {{$expert->first_name}}</h5>
                                            @if(isset($expert->profile->experience))
                                                <span class="text-black">{{trans('profile.experience')}} :
                                                    <b>{{$expert->profile->experience }} {{trans('profile.year')}}</b>
                                                </span>
                                                <br>
                                            @endif
                                            @if(isset($expert->profile->departure))
                                                <span class="text-black">{{trans('profile.departure')}} :
                                                    <b>{{ $expert->profile->departure == 1 ? trans('profile.yes') : trans('profile.no') }}</b>
                                                </span>
                                                <br>
                                            @endif
                                            <span
                                                class="text-black">{{trans('auth.city')}}: <b>{{$expert->city->title}}</b></span>
                                            <br>
                                            @if($expert->services->min('price') != null)
                                                <span class="text-black">{{trans('profile.price')}}
                                                <b>{{$expert->services->min('price')}}</b></span>
                                                <br>
                                            @endif
                                            <a class="button red text-white"
                                               href="{{route('expert-profile', $expert->id )}}">{{trans('car.check.read-more')}}</a>
                                            <input type="hidden" value="{{$expert->id}}" name="expert_id">
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                        <!-- ============================================ -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="pagination-nav d-flex justify-content-center">
{{--                {{$experts->links()}}--}}
            </div>
        </div>
    </section>
@endsection
