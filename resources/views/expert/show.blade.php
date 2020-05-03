@extends('layouts.app')
@section('content')
    <section class="page-left-sidebar page-section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="blog-sidebar">
                        <div class="sidebar-widget">
                            <div class="team-image">
                                @if(isset($expert->profile->image))
                                    <img class="img-fluid icon" src="{{'/storage/'.$expert->profile->image}}" alt="">
                                @else
                                    <img class="img-fluid icon" src="{{asset('images/profile/default-user.png')}}" alt="">
                                @endif
                            </div>
                        </div>
                        <div class="sidebar-widget">
                            <h6>{{trans('profile.skills')}}</h6>
                            <div class="tags">
                                <div class="details-nav">
                                    <ul>
                                        @foreach($expert->skill as $skill)
                                            <li>
                                                <a class="delete_skill">{{ $skill->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 profile-info">
                    <h5>{{$expert->first_name }}  </h5>
                    <ul class="list-style-1 mt-3">
                        <li><p><i class="fa fa-home"></i>{{$expert->city->title}}</p></li>
{{--                        <li><p><i class="fa fa-phone"></i>{{$expert->phone}}</p></li>--}}
{{--                        <li><p><i class="fa fa-mail-reply"></i>{{$expert->email }}</p></li>--}}
                        @if(isset($expert->profile->departure))
                            <li><p><i class="fa fa-home"></i>{{trans('profile.departure')}} : {{ $expert->profile->departure == 1 ? trans('profile.yes') : trans('profile.no') }}</p></li>
                        @endif
                        @if(isset($expert->profile->experience))
                            <li><p><i class="fa fa-level-up"></i>{{trans('profile.experience')}} : {{$expert->profile->experience }} {{trans('profile.year')}}</p></li>
                        @endif
                    </ul>
                    <br>
                    <div class="price-block">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>{{trans('profile.services.title')}}</th>
                                <th>{{trans('profile.services.price')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($expert->services as $service)
                                <tr>
                                    <th scope="row">{{$service->title}}</th>
                                    <td>{{$service->price}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <input type="hidden" name="expert_id" value="{{$expert->id}}" form="expertFormSelect">
                        <a data-toggle="modal"  class="button red text-white" data-target="#selectExpert">{{trans('car.check.select')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
