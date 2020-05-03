    @extends('layouts.app')
    @section('content')
        <section class="inner-intro bg-2 bg-overlay-black-70">
            <div class="container">
                <div class="row text-center intro-title">
                    <div class="col-md-6 text-md-left d-inline-block">
                        <h1 class="text-white">{{trans('header.check')}}</h1>
                    </div>
                    <div class="col-md-6 text-md-right float-right">
                        <ul class="page-breadcrumb">
                            <li>
                                <a href="{{route('home')}}"><i class="fa fa-home"></i> {{trans('header.home')}}</a>
                                <i class="fa fa-angle-double-right"></i>
                            </li>
                            <li><span>{{trans('header.check')}}</span><i class="fa fa-angle-double-right"></i></li>
                            <li><span>{{trans('header.check-step-final')}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="login-form page-section-ptb">
            <form class="entrance__form" method="post" action="{{route('check-step-save-form')}}">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h2>{{trans('car.check.title-3')}}</h2>
                                <div class="separator"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-12">
                            <div class="gray-form clearfix">
                                @if($user_info['link'] != null)
                                    <div class="form-group">
                                        <label for="link">{{trans('car.check.car-link')}}</label>
                                        <input id="link" class="form-control placeholder" type="text" name="link"
                                               value="{{$user_info['link']}}" >
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="name">{{trans('car.check.name')}}</label>
                                    <input id="name" class="form-control placeholder" type="text" name="name"
                                           value="{{$user_info['name']}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">{{trans('car.check.phone')}}</label>
                                    <input id="phone" class="form-control placeholder txtLogin" type="text" name="phone"
                                           value="{{$user_info['phone']}}"  required>
                                </div>
                                <div class="form-group">
                                    <label for="expert">{{trans('car.check.expert')}}</label>
                                    <input id="expert" class="form-control placeholder" type="text" name="expert_name"
                                           value="{{$expert_name}}" readonly>
                                    <input type="hidden" value="{{$expert_id}}" name="expert_id">
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <input type="submit" class="btn btn-danger">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    @endsection
