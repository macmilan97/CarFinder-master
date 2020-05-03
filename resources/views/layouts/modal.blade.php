<!-- Message Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                @if ($message = Session::get('success'))
                    <h6 class="text-center text-success">{!! $message !!}</h6>
                @endif
                @if ($message = Session::get('error'))
                    <h6 class="text-center text-danger">{!! $message !!}</h6>
                @endif
                @if ($message = Session::get('warning'))
                    <h6 class="text-center text-danger">{!! $message !!}</h6>
                @endif
                @if ($message = Session::get('info'))
                    <h6 class="text-center text-danger">{!! $message !!}</h6>
                @endif
                @if ($errors->any())
                    @foreach($errors->all() as $error)
                        <ul class="questions">
                            <li class="text-danger"><h6>{!! $error !!}</h6></li>
                        </ul>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Address Modal -->
<div class="modal fade" id="selectCity" tabindex="-1" role="dialog" aria-labelledby="selectCity" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{trans('modal.select.city')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="{{route('select-city')}}">
                <div class="modal-body">
                    <div class="row">
                        @foreach($cities as $city)
                            <div class="col-lg-6 col-md-6 text-center">
                                <label for="city-{{$city->id}}" id="cityClicked-{{$city->id}}"
                                       class="label-city">{{$city->title}}</label>
                                <input id="city-{{$city->id}}" type="radio" value="{{$city->id}}" name="select_city"
                                       class="select-city-input">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-12 ">
                        <button type="submit" class="button red pull-left border-0">{{trans('modal.send')}}</button>
                        <button type="button" class="button red pull-right border-0"
                                data-dismiss="modal">{{trans('modal.close')}}</button>
                    </div>
                </div>
                @csrf
            </form>
        </div>
    </div>
</div>
@if(Request::route()->getName() == 'profile')
    @if(count($diffSkills) != 0 )
        <div class="modal fade" id="selectSkill" tabindex="-1" role="dialog" aria-labelledby="selectSkill"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{trans('profile.skill.select')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form method="post" action="{{route('skill-add')}}">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <select id="multiple" class="form-control" name="skill_name[]" multiple>
                                    @foreach($diffSkills as $skill)
                                        <option value="{{$skill['id']}}"> {{$skill['title']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-md-12 ">
                                <button type="submit"
                                        class="button red pull-left border-0">{{trans('modal.send')}}</button>
                                <button type="button" class="button red pull-right border-0"
                                        data-dismiss="modal">{{trans('modal.close')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endif

<div class="modal fade" id="selectExpert" tabindex="-1" role="dialog" aria-labelledby="selectExpert" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{trans('modal.select.expert')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="expertFormSelect" method="post" class="entrance__form" action="{{route('modal-select-expert')}}">
                @csrf
                <div class="modal-body">

                    <div class="col-lg-12 col-md-12">
                        <div class="gray-form clearfix">

                            <div class="form-group">
                                <label for="name">{{trans('car.check.name')}}</label>
                                <input id="name" class="form-control placeholder" type="text" name="name" >
                            </div>
                            <div class="form-group">
                                <label for="phone">{{trans('car.check.phone')}}</label>
                                <input id="phone" class="form-control placeholder txtLogin" type="text" name="phone" >
                            </div>
                            <div class="form-group">
                                <label for="type">{{ trans('modal.select.type') }}</label>
                                <select id="type" class="form-control" name="type">
                                    <option selected
                                            disabled>{{trans('modal.select.type-dis')}}</option>
                                    <option value="{{\App\Models\Request::TYPE_PICK_UP}}">{{trans('header.pick-up')}}</option>
                                    <option value="{{\App\Models\Request::TYPE_CHECK}}">{{trans('header.check')}}</option>
                                </select>
                            </div>
                            <div class="form-group order-block" style="display: none">
                                <label for="order">{{ trans('car.check.title-1') }}</label>
                                <select id="orders" class="form-control" name="order[]" multiple="multiple">
                                    <option selected
                                            disabled>{{trans('modal.select.order-pick-up')}}</option>
                                    <option value="interior">{{trans('car.check.car-interior')}}</option>
                                    <option value="body">{{trans('car.check.car-body')}}</option>
                                    <option value="box">{{trans('car.check.car-box')}}</option>
                                    <option value="wheel">{{trans('car.check.car-wheel')}}</option>
                                    <option value="engine">{{trans('car.check.car-engine')}}</option>
                                    <option value="speedometer">{{trans('car.check.car-speedometer')}}</option>
                                    <option value="disc">{{trans('car.check.car-disc')}}</option>
                                    <option value="electrical">{{trans('car.check.car-electrical')}}</option>
                                    <option value="suspension">{{trans('car.check.car-suspension')}}</option>
                                    <option value="taxi">{{trans('car.check.car-taxi')}}</option>
                                    <option value="exhaust">{{trans('car.check.car-exhaust')}}</option>
                                    <option value="turbo">{{trans('car.check.car-turbo')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="button red pull-left border-0">{{trans('modal.send')}}</button>
                            <button type="button" class="button red pull-right border-0"
                                    data-dismiss="modal">{{trans('modal.close')}}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="leaveRequest" tabindex="-1" role="dialog" aria-labelledby="leaveRequest" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{trans('modal.select.expert')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form  method="post" class="entrance__form" action="{{route('leave-request')}}">
                @csrf
                <div class="modal-body">

                    <div class="col-lg-12 col-md-12">
                        <div class="gray-form clearfix">

                            <div class="form-group">
                                <label for="names">{{trans('car.check.name')}}</label>
                                <input id="names" class="form-control placeholder" type="text" name="name" >
                            </div>
                            <div class="form-group">
                                <label for="phones">{{trans('car.check.phone')}}</label>
                                <input id="phones" class="form-control placeholder txtLogin" type="text" name="phone" >
                            </div>
                            <div class="form-group">
                                <label for="types">{{ trans('modal.select.type') }}</label>
                                <select id="types" class="form-control" name="type">
                                    <option selected
                                            disabled>{{trans('modal.select.type-dis')}}</option>
                                    <option value="{{\App\Models\Request::TYPE_PICK_UP}}">{{trans('header.pick-up')}}</option>
                                    <option value="{{\App\Models\Request::TYPE_CHECK}}">{{trans('header.check')}}</option>
                                </select>
                            </div>
                            <div class="form-group order-blocks" style="display: none">
                                <label for="orders">{{ trans('car.check.title-1') }}</label>
                                <select id="orders" class="form-control" name="order[]" multiple="multiple">
                                    <option selected
                                            disabled>{{trans('modal.select.order-pick-up')}}</option>
                                    <option value="interior">{{trans('car.check.car-interior')}}</option>
                                    <option value="body">{{trans('car.check.car-body')}}</option>
                                    <option value="box">{{trans('car.check.car-box')}}</option>
                                    <option value="wheel">{{trans('car.check.car-wheel')}}</option>
                                    <option value="engine">{{trans('car.check.car-engine')}}</option>
                                    <option value="speedometer">{{trans('car.check.car-speedometer')}}</option>
                                    <option value="disc">{{trans('car.check.car-disc')}}</option>
                                    <option value="electrical">{{trans('car.check.car-electrical')}}</option>
                                    <option value="suspension">{{trans('car.check.car-suspension')}}</option>
                                    <option value="taxi">{{trans('car.check.car-taxi')}}</option>
                                    <option value="exhaust">{{trans('car.check.car-exhaust')}}</option>
                                    <option value="turbo">{{trans('car.check.car-turbo')}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="comment">{{ trans('modal.select.type') }}</label>
                                <textarea rows="5" id="comment" autocomplete="comment"
                                          class="form-control placeholder"
                                          type="text" name="comment"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="button red pull-left border-0">{{trans('modal.send')}}</button>
                            <button type="button" class="button red pull-right border-0"
                                    data-dismiss="modal">{{trans('modal.close')}}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $("input[name='select_city']").on('change', function () {
        var id = $(this).attr("id");
        $(".label-city").removeClass("text-danger");
        $("#cityClicked-" + id.replace('city-', '')).addClass("text-danger");
    });
    $("select[id='type']").on('change', function () {
       var id = $(this).val();
        if(parseInt(id) === 1) {
            $('.order-block').show()
        }else {
            $('.order-block').hide()
        }

    });
    $("select[id='types']").on('change', function () {
        var id = $(this).val();
        if(parseInt(id) === 1) {
            $('.order-blocks').show()
        }else {
            $('.order-blocks').hide()
        }

    });
    function showOrder(id) {
        if(parseInt(id) === 1) {
            $('.order-block').show()
        }else {
            $('.order-block').hide()
        }
    }
</script>

