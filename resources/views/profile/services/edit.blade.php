@extends('layouts.app')
@section('content')
    <section class="register-form page-section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2>{{trans('profile.services.edit')}}</h2>
                        <div class="separator"></div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 mb-3 col-lg-12">
                    <form method="post" action="{{route('service-update', $service->id)}}">
                        {{ method_field('PUT') }}
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label for="service_name">{{trans('profile.services.title')}}</label>
                                <input id="service_name" value="{{$service->title}}" class="form-control placeholder" name="service_title" required>
                            </div>
                            <div class="col-md-4">
                                <label for="service_price">{{trans('profile.services.price')}}</label>
                                <input id="service_price" value="{{$service->price}}" class="form-control placeholder" name="service_price"
                                       required>
                            </div>
                            <div class="col-md-4">
                                <button type="submit"
                                        class="button position-absolute fixed-bottom red align-bottom " style="left: 50px">{{trans('profile.services.save')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
