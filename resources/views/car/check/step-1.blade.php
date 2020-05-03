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
                        <li><span>{{trans('header.check-step-one')}}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="why-choose page-section-pt car-check-block">
        <form class="" method="post" action="{{route('check-step-one-form')}}">
            @csrf
            <div class="container check-car">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h2>{{trans('car.check.title-1')}}</h2>
                            <div class="separator"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-box text-center">
                            <input type="checkbox" name="check_input[]" id="interior" value="interior"/>
                            <label for="interior">
                                <span class="icon">
                                    <i id="class-interior" class="glyph-icon flaticon-car-1"></i>
                                </span>
                                <span class="content">
                                    <h6>{{trans('car.check.car-interior')}}</h6>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-box text-center">
                            <input type="checkbox" name="check_input[]" id="body" value="body"/>
                            <label for="body">
                                <span class="icon">
                                    <i id="class-body" class="glyph-icon flaticon-car-repair"></i>
                                </span>
                                <span class="content">
                                    <h6>{{trans('car.check.car-body')}}</h6>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-box text-center">
                            <input type="checkbox" name="check_input[]" id="box" value="box"/>
                            <label for="box">
                                <span class="icon">
                                    <i id="class-box" class="glyph-icon flaticon-gearstick"></i>
                                </span>
                                <span class="content">
                                    <h6>{{trans('car.check.car-box')}}</h6>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-box text-center">
                            <input type="checkbox" name="check_input[]" id="wheel" value="wheel"/>
                            <label for="wheel">
                                <span class="icon">
                                    <i id="class-wheel" class="glyph-icon flaticon-wheel-alignment"></i>
                                </span>
                                <span class="content">
                                    <h6>{{trans('car.check.car-wheel')}}</h6>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-box text-center">
                            <input type="checkbox" name="check_input[]" id="engine" value="engine"/>
                            <label for="engine">
                                <span class="icon">
                                    <i id="class-engine" class="glyph-icon flaticon-engine"></i>
                                </span>
                                <span class="content">
                                    <h6>{{trans('car.check.car-engine')}}</h6>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 block-hide">
                        <img src="{{asset('images/car/check/06.jpg')}}" alt="" class="car-check-main" id="click_all">
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-box text-center">
                            <input type="checkbox" name="check_input[]" id="speedometer" value="speedometer"/>
                            <label for="speedometer">
                                <span class="icon">
                                    <i id="class-speedometer"
                                       class="glyph-icon flaticon-speedometer-circular-outlined-tool-symbol"></i>
                                </span>
                                <span class="content">
                                    <h6>{{trans('car.check.car-speedometer')}}</h6>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-box text-center">
                            <input type="checkbox" name="check_input[]" id="disc" value="disc"/>
                            <label for="disc">
                                <span class="icon">
                                    <i id="class-disc" class="glyph-icon flaticon-disc-brake"></i>
                                </span>
                                <span class="content">
                                    <h6>{{trans('car.check.car-disc')}}</h6>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 block-hide"></div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-box text-center">
                            <input type="checkbox" name="check_input[]" id="electrical" value="electrical"/>
                            <label for="electrical">
                                <span class="icon">
                                    <i id="class-electrical" class="glyph-icon flaticon-electrical-service"></i>
                                </span>
                                <span class="content">
                                    <h6>{{trans('car.check.car-electrical')}}</h6>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-box text-center">
                            <input type="checkbox" name="check_input[]" id="suspension" value="suspension"/>
                            <label for="suspension">
                                <span class="icon">
                                    <i id="class-suspension" class="glyph-icon flaticon-suspension"></i>
                                </span>
                                <span class="content">
                                    <h6>{{trans('car.check.car-suspension')}}</h6>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-box text-center">
                            <input type="checkbox" name="check_input[]" id="taxi" value="taxi"/>
                            <label for="taxi">
                                <span class="icon">
                                    <i id="class-taxi" class="glyph-icon flaticon-transport-2"></i>
                                </span>
                                <span class="content">
                                    <h6>{{trans('car.check.car-taxi')}}</h6>
                                </span>
                            </label>
                        </div>

                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-box text-center">
                            <input type="checkbox" name="check_input[]" id="exhaust" value="exhaust"/>
                            <label for="exhaust">
                                <span class="icon">
                                    <i id="class-exhaust" class="glyph-icon flaticon-exhaust-pipe"></i>
                                </span>
                                <span class="content">
                                    <h6>{{trans('car.check.car-exhaust')}}</h6>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-box text-center">
                            <input type="checkbox" name="check_input[]" id="turbo" value="turbo"/>
                            <label for="turbo">
                                <span class="icon">
                                    <i id="class-turbo" class="glyph-icon flaticon-tire"></i>
                                </span>
                                <span class="content">
                                    <h6>{{trans('car.check.car-turbo')}}</h6>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <input type="submit" class="btn btn-danger" value="{{trans('car.check.send')}}">
                </div>
            </div>
        </form>
    </section>
    <script
        src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
        crossorigin="anonymous"></script>
    <script>
        $("label").on('click', function () {
            var id = $(this).attr("for");
            if (!$('#' + id).is(':checked')) {
                $("#class-" + id).addClass("clicked")
            } else {
                $("#class-" + id).removeClass("clicked")
            }

        });
        $('#click_all').on('click', function () {
            if (!$('input[name="check_input[]"]').is(':checked')) {
                $('input[name="check_input[]"]').prop('checked', true);
                $('.glyph-icon').addClass("clicked")
            } else {
                $('input[name="check_input[]"]').prop('checked', false);
                $(".glyph-icon").removeClass("clicked")
            }
        })
    </script>
@endsection
