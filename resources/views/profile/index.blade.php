@extends('layouts.app')
@section('content')
    <section class="page-left-sidebar page-section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="blog-sidebar">
                        <div class="sidebar-widget">
                            <div class="team-image">
                                @if(isset(Auth::user()->profile->image))
                                    <img class="img-fluid icon" src="{{'/storage/'.Auth::user()->profile->image}}"
                                         alt="">
                                @else
                                    <img class="img-fluid icon" src="{{asset('images/profile/default-user.png')}}"
                                         alt="">
                                @endif
                            </div>
                        </div>
                        <div class="sidebar-widget">
                            <div class="widget-link">
                                <ul>
                                    <li><a href="{{route('order-all')}}"> <i
                                                class="fa fa-angle-right"></i> {{trans('profile.orders-all')}} <b
                                                class="text-danger">({{$count_all}})</b></a>
                                    </li>
                                    <li><a href="{{route('order-personal')}}"> <i
                                                class="fa fa-angle-right"></i> {{trans('profile.orders')}} <b
                                                class="text-danger">({{$count_active}})</b></a>
                                    </li>
                                    <li><a href="{{route('order-completed')}}"> <i
                                                class="fa fa-angle-right"></i> {{trans('profile.completed')}} <b
                                                class="text-danger">({{$count_done}})</b></a>
                                    </li>
                                    <li><a href="{{route('profile-document')}}"> <i class="fa fa-angle-right"></i> {{trans('profile.document.title')}}
                                        </a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-widget">
                            <h6>{{trans('profile.skills')}}</h6>
                            <div class="tags">
                                <div class="details-nav">
                                    <ul>
                                        @if(isset($skill))
                                            @foreach(Auth::user()->skill as $skill)
                                                <li>
                                                    <a class="delete_skill"
                                                       onclick="return confirm('{{trans('profile.confirm.delete')}}');"
                                                       id="skill-{{$skill->id}}">{{ $skill->title }} <i
                                                            class="delete-icon">X</i></a>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            @if(count($diffSkills) != 0 )
                                <div class="col-md-12 text-center">
                                    <a data-toggle="modal" data-target="#selectSkill"
                                       class="button red mt-4 text-white">{{trans('profile.skill.add')}}</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-8 profile-info">
                    <h5>{{Auth::user()->first_name .' '. Auth::user()->last_name }}  </h5>
                    <ul class="list-style-1 mt-3">
                        <li><p><i class="fa fa-home"></i>{{Auth::user()->city->title}}</p></li>
                        <li><p><i class="fa fa-phone"></i>{{Auth::user()->phone}}</p></li>
                        <li><p><i class="fa fa-mail-reply"></i>{{Auth::user()->email }}</p></li>
                        @if(isset(Auth::user()->profile->departure))
                            <li><p><i class="fa fa-home"></i>{{trans('profile.departure')}}
                                    : {{ Auth::user()->profile->departure == 1 ? trans('profile.yes') : trans('profile.no') }}
                                </p></li>
                        @endif
                        @if(isset(Auth::user()->profile->experience))
                            <li><p><i class="fa fa-level-up"></i>{{trans('profile.experience')}}
                                    : {{Auth::user()->profile->experience }} {{trans('profile.year')}}</p></li>
                        @endif
                        <li><a href="{{route('profile-edit')}}" class="link">{{trans('profile.edit')}}</a></li>
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
                            @foreach(Auth::user()->services as $service)
                                <tr>
                                    <th scope="row">{{$service->title}}</th>
                                    <td>{{$service->price}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <a href="{{route('service-crud')}}"
                           class="button red">{{trans('profile.services.add-edit')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script
        src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
        crossorigin="anonymous"></script>
    <script>
        $(".delete_skill").on('click', function () {
            var click_id = $(this).attr("id");
            var id = click_id.replace('skill-', '');
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax(
                {
                    url: "profile/skill/delete/" + id,
                    type: 'DELETE',
                    data: {
                        "id": id,
                        "_token": token,
                    },
                    success: function () {
                        $('#' + click_id).remove();

                    }
                });
        });
    </script>
@endsection
