@extends('layouts.app')
@section('content')
    <section class="register-form page-section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2>{{trans('profile.services.add')}}</h2>
                        <div class="separator"></div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">

                <div class="col-md-12 mb-3 col-lg-8">
                    <form method="post" action="{{route('service-add')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label for="service_name">{{trans('profile.services.title')}}</label>
                                <input id="service_name" class="form-control placeholder" name="service_title" required>
                            </div>
                            <div class="col-md-4">
                                <label for="service_price">{{trans('profile.services.price')}}</label>
                                <input id="service_price" class="form-control placeholder" name="service_price"
                                       required>
                            </div>
                            <div class="col-md-4">
                                <button type="submit"
                                        class="button position-absolute fixed-bottom red align-bottom">{{trans('profile.services.save')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{trans('profile.services.title')}}</th>
                        <th scope="col">{{trans('profile.services.price')}}</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($services as $service)
                        <tr>
                            <td>{{$service->id}}</td>
                            <td>{{$service->title}}</td>
                            <td>{{$service->price}}</td>
                            <td>
                                <a href="{{route('service-edit', $service->id)}}"
                                   class="button red pull-left">{{trans('profile.services.edit')}}</a>
                                <form method="post" action="{{route('service-delete', $service->id)}}">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="button red pull-right">{{trans('profile.services.delete')}}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
