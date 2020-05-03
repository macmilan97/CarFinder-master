<header id="header" class="topbar-dark header-dark">
    <div class="topbar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5 col-md-12">
                    <div class="topbar-left text-lg-left text-center">
                        <ul class="list-inline">
                            <li><i class="fa fa-envelope-o"> </i> support@car-finder.kz</li>
                            <li><a data-toggle="modal" data-target="#selectCity"><i
                                        class="fa fa-map-marker"></i> {{trans('header.address')}}</a></li>
                            <li>{!! $user_city !!}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12 text-lg-right text-center">

                    <div class="topbar-right">
                        <ul class="list-inline">
                            @if(Auth::guard('expert')->check())
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                                    {{trans('header.logout')}}
                                </a>
                                <form id="frm-logout" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            @endif
                            <li><i class="fa fa-phone"></i> +7(7272)456 7890</li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=================================
     mega menu -->
    <div class="menu">
        <!-- menu start -->
        <nav id="menu" class="mega-menu">
            <!-- menu list items container -->
            <section class="menu-list-items">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- menu logo -->
                            <ul class="menu-logo">
                                <li>
                                    <a href="{{route('home')}}">
                                        <img id="" src="{{Voyager::image(setting('site.logo'))}}" alt="logo">
                                    </a>
                                    <div class="menu-mobile-collapse-trigger"><span></span></div>
                                </li>
                            </ul>
                            <!-- menu links -->
                            <ul class="menu-links" style="max-height: 400px; overflow: auto; display: none;">
                                <!-- active class -->
                                <li class="{{(\Request::route()->getName() == 'home') ? 'active' : ''}} hoverTrigger">
                                    <a href="{{route('home')}}">{{trans('header.home')}}</a>
                                </li>
                                <li class="{{ \Request::is('car/pick-up', 'car/pick-up/*') ? 'active': ''}} hoverTrigger">
                                    <a href="{{route('pick-up')}}">{{trans('header.pick-up')}}</a>
                                </li>
                                <li class="{{ \Request::is('car/check', 'car/check/*') ? 'active': ''}} hoverTrigger">
                                    <a href="{{route('check-step-one')}}">{{trans('header.check')}}</a>
                                </li>
                                <li class="{{ \Request::is('experts', 'expert/*') ? 'active': ''}} hoverTrigger">
                                    <a href="{{route('experts')}}">{{trans('header.expert')}}</a>
                                </li>
                            </ul>
                            <ul class="submit-button float-right list-inline">
                                <li ><a href="{{url('login')}}" class="" title="{{trans('header.login-title')}}" ><i class="fa fa-user {{ \Request::is('profile', 'profile/*') ? ' login-active': ''}}"></i> </a></li>
                                @if(!Auth::guard('expert')->check())
                                    <li><a data-toggle="modal"  class="button red text-white" data-target="#leaveRequest">{{trans('header.request')}}</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </nav>
        <!-- menu end -->
    </div>
</header>
