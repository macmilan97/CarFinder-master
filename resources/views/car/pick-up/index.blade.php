@extends('layouts.app')
@section('content')
    <section class="inner-intro bg-5 bg-overlay-black-70">
        <div class="container">
            <div class="row text-center intro-title">
                <div class="col-md-6 text-md-left d-inline-block">
                    <h1 class="text-white">{{trans('header.pick-up')}}</h1>
                </div>
                <div class="col-md-6 text-md-right float-right">

                    <ul class="page-breadcrumb">
                        <li>
                            <a href="{{route('home')}}"><i class="fa fa-home"></i> {{trans('header.home')}}</a>
                            <i class="fa fa-angle-double-right"></i>
                        </li>
                        <li><span>{{trans('header.pick-up')}}</span>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="page-section-ptb gray-bg pick-up">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-md-12">
                    <form method="post" action="{{route('pick-up-save-input')}}">
                        @csrf
                        <h6>{{trans('pick-up.car-type')}} </h6>
                        <div class="row">
                            @foreach($carTypes as $type)
                                <div class="col-lg-2 col-md-4">
                                    <input type="radio" class="select-hidden" name="car_type" id="type-{{$type->id}}"
                                           value="{{$type->id}}"/>
                                    <label class="car-type" for="type-{{$type->id}}">
                                        <div class="search-logo-box" id="type-{{$type->id}}-image">
                                            <img class=""
                                                 src="{{Voyager::image($type->image)}}"
                                                 alt="{{$type->getTranslatedAttribute('title', $locale, 'fallbackLocale')}}">
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>{{trans('pick-up.car-make.title')}} </h6>
                                <select name="car_make" class="form-control">
                                    <option selected disabled>{{trans('pick-up.car-make.selected')}}</option>
                                    @foreach($carMakes as $make)
                                        <option
                                            value="{{$make->id}}">{{$make->getTranslatedAttribute('title', $locale, 'fallbackLocale')}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <h6>{{trans('pick-up.car-model.title')}} </h6>
                                <select name="car_model" class="form-control" id="car-model-block">
                                    <option selected disabled>{{trans('pick-up.car-model.selected')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tabcontent accordion" style="">
                                    <div class="accordion-title">
                                        <a href="#" class="disabled">{{trans('pick-up.search')}}</a>
                                    </div>
                                    <div class="accordion-content" style="display: none;">
                                        <div class="col-lg-12 col-md-12 ">
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="status">{{ trans('pick-up.status-label') }}</label>
                                                    <select id="status" class="form-control" name="status[]"
                                                            multiple="multiple">
                                                        <option selected
                                                                disabled>{{trans('pick-up.status.selected')}}</option>
                                                        <option value="new">{{trans('pick-up.status.new')}}</option>
                                                        <option value="working">{{trans('pick-up.status.working')}}</option>
                                                        <option
                                                            value="no-working">{{trans('pick-up.status.no-working')}}</option>
                                                        <option
                                                            value="damaged">{{trans('pick-up.status.damaged')}} </option>
                                                    </select>
                                                    <label for="body">{{ trans('pick-up.body') }}</label>
                                                    <select id="body" class="form-control" name="car_type">
                                                        <option selected
                                                                disabled>{{ trans('pick-up.body-selected') }}</option>
                                                        @foreach($carTypes as $type)
                                                            <option
                                                                value="{{$type->id}}">{{$type->getTranslatedAttribute('title', $locale, 'fallbackLocale')}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="kpp">{{ trans('pick-up.kpp') }}</label>
                                                    <select name="kpp[]" id="kpp" class="form-control" multiple="multiple">
                                                        <option selected
                                                                disabled>{{trans('pick-up.kpp-sel.selected')}}</option>
                                                        <option value="manual">{{trans('pick-up.kpp-sel.manual')}}</option>
                                                        <option value="akpp">{{trans('pick-up.kpp-sel.akpp')}}</option>
                                                        <option
                                                            value="tiptronic">{{trans('pick-up.kpp-sel.tiptronic')}}</option>
                                                        <option
                                                            value="variable">{{trans('pick-up.kpp-sel.variable')}} </option>
                                                        <option
                                                            value="robotised">{{trans('pick-up.kpp-sel.robotised')}} </option>
                                                    </select>

                                                    <label for="drive">{{ trans('pick-up.drive') }}</label>
                                                    <select class="form-control" id="drive" name="drive[]"
                                                            multiple="multiple">
                                                        <option disabled selected>{{trans('pick-up.drive-select')}}</option>
                                                        <option value="full">{{trans('pick-up.drive-full')}}</option>
                                                        <option value="front">{{trans('pick-up.drive-front')}}</option>
                                                        <option value="back">{{trans('pick-up.drive-back')}}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="mileage">{{ trans('pick-up.mileage') }}</label>
                                                    <input id="mileage" autocomplete="mileage"
                                                           value="{{ old('mileage') }}"
                                                           class="form-control placeholder"
                                                           type="number" name="mileage">
                                                    <label for="engine">{{ trans('pick-up.engine') }}</label>
                                                    <select id="engine" name="engine[]" class="form-control"
                                                            multiple="multiple">
                                                        <option selected
                                                                disabled>{{trans('pick-up.engines.selected')}}</option>
                                                        <option value="petrol">{{trans('pick-up.engines.petrol')}}</option>
                                                        <option value="diesel">{{trans('pick-up.engines.diesel')}}</option>
                                                        <option value="gas">{{trans('pick-up.engines.gas')}}</option>
                                                        <option value="hybrid">{{trans('pick-up.engines.hybrid')}}</option>
                                                        <option
                                                            value="electricity">{{trans('pick-up.engines.electricity')}}</option>
                                                    </select>
                                                    <label for="rudder">{{ trans('pick-up.rudders') }}</label>
                                                    <select id="rudder" class="form-control" name="rudder[]"
                                                            multiple="multiple">
                                                        <option selected
                                                                disabled>{{trans('pick-up.rudder.selected')}}</option>
                                                        <option value="left">{{trans('pick-up.rudder.left')}}</option>
                                                        <option value="right">{{trans('pick-up.rudder.right')}}</option>
                                                    </select>
                                                    <label for="color">{{ trans('pick-up.colors') }}</label>
                                                    <select id="color" name="color[]" class="form-control"
                                                            multiple="multiple">
                                                        <option value="no" selected>{{trans('pick-up.color.no')}}</option>
                                                        <option value="bronze">{{trans('pick-up.color.bronze')}}</option>
                                                        <option value="cherry">{{trans('pick-up.color.cherry')}}</option>
                                                        <option
                                                            value="chameleon">{{trans('pick-up.color.chameleon')}}</option>
                                                        <option value="beige">{{trans('pick-up.color.beige')}}</option>
                                                        <option value="white">{{trans('pick-up.color.white')}}</option>
                                                        <option
                                                            value="turquoise">{{trans('pick-up.color.turquoise')}}</option>
                                                        <option value="vinous">{{trans('pick-up.color.vinous')}}</option>
                                                        <option
                                                            value="light_blue">{{trans('pick-up.color.light_blue')}}</option>
                                                        <option value="yellow">{{trans('pick-up.color.yellow')}}</option>
                                                        <option value="green">{{trans('pick-up.color.green')}}</option>
                                                        <option value="golden">{{trans('pick-up.color.golden')}}</option>
                                                        <option value="brown">{{trans('pick-up.color.brown')}}</option>
                                                        <option value="red">{{trans('pick-up.color.red')}}</option>
                                                        <option value="orange">{{trans('pick-up.color.orange')}}</option>
                                                        <option value="pink">{{trans('pick-up.color.pink')}}</option>
                                                        <option value="silver">{{trans('pick-up.color.silver')}}</option>
                                                        <option value="grey">{{trans('pick-up.color.grey')}}</option>
                                                        <option value="blue">{{trans('pick-up.color.blue')}}</option>
                                                        <option value="lilac">{{trans('pick-up.color.lilac')}}</option>
                                                        <option value="violet">{{trans('pick-up.color.violet')}}</option>
                                                        <option value="black">{{trans('pick-up.color.black')}}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="volume">{{ trans('pick-up.volume') }}</label>
                                                    <input id="volume" autocomplete="" value="{{ old('volume') }}"
                                                           class="form-control"
                                                           type="number" name="volume">
                                                    <input autocomplete="" placeholder="{{trans('pick-up.before')}}"
                                                           value="{{ old('before') }}"
                                                           class="form-control before"
                                                           type="number" name="before">
                                                    <input autocomplete="" placeholder="{{trans('pick-up.after')}}"
                                                           value="{{ old('after') }}"
                                                           class="form-control after"
                                                           type="number" name="after">
                                                    <label for="comment">{{ trans('pick-up.comment') }}</label>
                                                    <textarea rows="5" id="comment" autocomplete="comment"
                                                              class="form-control placeholder"
                                                              type="text" name="comment"></textarea>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <div class="price-slide">
                                                        <div class="price">
                                                            <label for="amount"
                                                                   class="text-center">{{ trans('pick-up.price') }}</label>
                                                            <input type="text" id="amount" class="amount" name="amount"
                                                                   value="0 - 1 000 000">
                                                            <div id="slider-range"
                                                                 class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                                                                <div
                                                                    class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                                                <span
                                                                    class="ui-slider-handle ui-state-default ui-corner-all"></span>
                                                                <span
                                                                    class="ui-slider-handle ui-state-default ui-corner-all"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="button red">{{trans('pick-up.send')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(".car-type").on('click', function () {
            var id = $(this).attr("for");
            if (!$(id).is(':checked')) {
                $('.search-logo-box').removeClass("type-active")
                $('#' + id + '-image').addClass("type-active")
                updateAttr(id.replace('type-', ''))
            }
        });

        function updateAttr(id) {
            $("select[name='car_type'] option").each(function () {
                $(this).removeAttr("selected");
                if ($(this).attr('value') === id)
                    $(this).attr("selected", "selected");
            });
        }

        $("select[name='car_type']").on('change', function () {
            var id = $(this).val();
            $('.search-logo-box').removeClass("type-active")
            $('#type-' + id + '-image').addClass("type-active")
        });

        $(".car-make").on('click', function () {
            var id = $(this).attr("for");
            if (!$(id).is(':checked')) {
                $('.car-make').removeClass("text-danger");
                $(this).addClass("text-danger")
            }
        });

        function carModelClick() {
            $(".car-model").on('click', function () {
                var id = $(this).attr("for");
                if (!$(id).is(':checked')) {
                    $('.car-model').removeClass("text-danger");
                    $(this).addClass("text-danger")
                }
            });
        }

        $("select[name='car_make']").on('change', function () {
            var id = $(this).val();
            $.ajax({
                url: '/car/pick-up/car/models/' + id,
                type: "GET",
                dataType: "json",
                beforeSend: function () {
                    document.getElementById("car-model-block").innerHTML = "";
                    $("#car-model-block").append("<option selected disabled>{{trans('pick-up.car-model.selected')}}</option>")
                },
                success: function (data) {
                    $.each(data, function (title, value) {
                        $("#car-model-block").append('<option value=" ' + value['id'] + '">' +
                            value['title'] + '</option>')
                    });
                    carModelClick()
                }
            });
        });
    </script>
@stop
