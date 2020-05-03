@extends('layouts.app')
@section('content')
    <section class="register-form page-section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2>{{trans('profile.orders-personal-one')}}</h2>
                        <div class="separator"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p class="text-dark">{{trans('profile.order.name')}}: <b>{{$request->name}}</b></p>
                    <p class="text-dark">{{trans('profile.order.type')}}:
                        <b>
                            @if($request->type == 1)
                                {{trans('profile.order.check')}}
                            @elseif($request->type == 2)
                                {{trans('profile.order.pick-up')}}
                            @endif
                        </b>
                    </p>
{{--                    <p class="text-dark">{{trans('profile.order.phone')}}: <b><a--}}
{{--                                href="tel:+7{{$request->phone}}">+7{{$request->phone}}</a></b>--}}
{{--                    </p>--}}
{{--                    @if($request->link != null)--}}
{{--                        <p class="text-dark">{{trans('profile.order.link')}}: <b><a href="//{{$request->link}}"--}}
{{--                                                                                    target="_blank">{{$request->link}}</a></b>--}}
{{--                        </p>--}}
{{--                    @endif--}}
                    @if($request->comment != null)
                        <p class="text-dark">{{trans('profile.order.comment')}}: <b>{{$request->comment}}</b></p>
                    @endif
                    @if($request->price != null)
                        <p class="text-dark">{{trans('profile.order.price')}}: <b>{{$request->price}}</b></p>
                    @endif
                    <p class="text-dark">{{trans('profile.order.status.title')}}:
                        <b>
                            @switch($request->status)
                                @case(0)
                                {{ trans('profile.order.status.no') }}
                                @break
                                @case(1)
                                {{ trans('profile.order.status.active') }}
                                @break
                                @case(2)
                                {{ trans('profile.order.status.done') }}
                                @break
                                @case(3)
                                {{ trans('profile.order.status.refused') }}
                                @break
                            @endswitch
                        </b>
                    </p>
                    @if($request->status != 3)
                        <form method="post" action="{{route('request-status-update')}}">
                            @csrf
                            <input name="request_id" value="{{$request->id}}" type="hidden">
                            @if($request->status == 0)
                                <input name="status" value="1" type="hidden">
                                <button type="submit" class="button red">{{trans('profile.order.start')}}</button>
                            @elseif($request->status == 1)
                                <input name="status" value="2" type="hidden">
                                <button type="submit" class="button red">{{trans('profile.order.done')}}</button>
                            @endif
                        </form>
                    @endif
                </div>
                <div class="col-md-6">
                    @if($request->order != null)
                        <p class="text-dark">{{trans('profile.order.title')}}:
                            <b><br>
                                {{trans('profile.order.type-'.$request->type)}}
                                @if($request->type == 1)
                                    <ul class="list-style-1 text-dark ml-3">
                                        @foreach(json_decode($request->order) as $order)
                                            <li><i class="fa fa-angle-right"></i>{{trans('car.check.car-'.$order)}}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </b>
                        </p>
                    @endif
                </div>
            </div>

        </div>
    </section>
@endsection
