@extends('layouts.app')
@section('content')
    <section class="slider-parallax car-directory-banner bg-overlay-black-70 bg-1 bg-overlay-black-77">
        <div class="slider-content-middle">

        </div>
    </section>
    <section class="page-section-ptb gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <a href="{{route('pick-up')}}">
                        <div class="feature-box-5">
                            <div class="icon">
                                <i class="flaticon-key"></i>
                            </div>
                            <div class="info">
                                <h5>{!! trans('home.pick-up') !!}</h5>
                                <p class="text-dark">{{trans('home.pick-up-text')}}</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{route('check-step-one')}}">
                        <div class="feature-box-5">
                            <div class="icon">
                                <i class="flaticon-inspection"></i>
                            </div>
                            <div class="info">
                                <h5>{!! trans('home.check-car') !!}</h5>
                                <p class="text-dark">{{trans('home.check-car-text')}}</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-12">
                    <a href="{{route('experts')}}">
                        <div class="feature-box-5">
                            <div class="icon">
                                <i class="flaticon-medal"></i>
                            </div>
                            <div class="info">
                                <h5>{!! trans('home.expert') !!}</h5>
                                <p class="text-dark">{{trans('home.expert-text')}}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="custom-block-3 white-bg page-section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="title">
                        <h3>{{trans('home.about')}}</h3>
                    </div>
                    <div class="content">
                        {!! $about->body !!}
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <img class="img-fluid" src="{{asset('images/car/11.png')}}" alt="">
                </div>
            </div>
        </div>
    </section>
    <section class="counter counter-style-2 bg-red bg-5 bg-overlay-black-70 page-section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 item">
                    <div class="counter-block text-left">
                        <div class="separator"></div>
                        <div class="info">
                            <h6 class="text-white">{{trans('home.car-check-count')}}</h6>
                            <i class="glyph-icon flaticon-beetle"></i>
                            <b class="timer text-white" data-to="{{rand(0, 100)}}" data-speed="10000">0</b>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 item">
                    <div class="counter-block text-left">
                        <div class="separator"></div>
                        <div class="info">
                            <h6 class="text-white">{{trans('home.user-happy-count')}}</h6>
                            <i class="glyph-icon flaticon-flag"></i>
                            <b class="timer text-white" data-to="{{rand(0, 100)}}" data-speed="10000">0</b>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 item">
                    <div class="counter-block text-left">
                        <div class="separator"></div>
                        <div class="info">
                            <h6 class="text-white">{{trans('home.expert-count')}}</h6>
                            <i class="glyph-icon flaticon-circle"></i>
                            <b class="timer text-white" data-to="{{$experts}}" data-speed="10000">0</b>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 item">
                    <div class="counter-block text-left">
                        <div class="separator"></div>
                        <div class="info">
                            <h6 class="text-white">{{trans('home.done-count')}}</h6>
                            <i class="glyph-icon flaticon-cup"></i>
                            <b class="timer text-white" data-to="{{rand(0, 100)}}" data-speed="10000">0</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="testimonial-4 white-bg page-section-ptb comment-block">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2>{{trans('home.comment')}}</h2>
                        <div class="separator"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme owl-loaded owl-drag">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                                @foreach($comments as $comment)
                                    <div class="owl-item">
                                        <div class="item">
                                            <div class="testimonial-block text-center">
                                                <i class="fa fa-quote-left"></i>
                                                <p>{{$comment->body}}</p>
                                                <h6 class="text-red">{{$comment->name}}</h6>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
