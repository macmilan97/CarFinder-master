@extends('layouts.app')
@section('content')
    <section class="register-form page-section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2>{{$title}}</h2>
                        <div class="separator"></div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{trans('profile.order.type')}}</th>
                        <th scope="col">{{trans('profile.order.name')}}</th>
                        <th scope="col">{{trans('profile.order.status.title')}}</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $counter = 0 @endphp
                    @foreach($requests as $request)
                        <tr>
                            <td>{{ ++ $counter}}</td>
                            <td>@if($request->type == 1)
                                    {{trans('profile.order.check')}}
                                @elseif($request->type == 2)
                                    {{trans('profile.order.pick-up')}}
                                @endif
                            </td>
                            <td>{{$request->name}}</td>
                            <td>
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
                            </td>
                            <td>
                                <a href="{{route('order-personal-show', $request->id)}}"
                                   class="button red pull-left">{{trans('profile.order.read-more')}}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container">
            <div class="pagination-nav d-flex justify-content-center">
                {{$requests->links()}}
            </div>
        </div>
    </section>
@endsection
