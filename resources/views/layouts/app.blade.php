<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="{{Voyager::setting('site.description')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{Voyager::setting('site.title')}}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}">
    <!-- bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <!-- flaticon -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/flaticon.css')}}">
    <!-- mega menu -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/mega-menu/mega_menu.css')}}">
    <!-- mega menu -->
    <link rel="stylesheet" type="text/css"
          href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css ">
    <!-- owl-carousel -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/owl-carousel/owl.carousel.css')}}">
    <!-- revolution -->
    <link rel="stylesheet" type="text/css" href="{{asset('revolution/css/settings.css')}}">
    <!-- animate -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/animate.min.css')}}">
    <!-- main style -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/car.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/jquery-ui.css')}}">
    <!-- responsive -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css')}}">
    <!-- Style customizer -->
    <link rel="stylesheet" href="{{asset('css/skins/skin-default.css')}}" data-style="styles">
<body>
<!--=================================
  loading -->
<div id="loading">
    <div id="loading-center">
        <img src="{{asset('images/loader.gif')}}" alt="">
    </div>
</div>
<!--=================================
  loading -->
<!--=================================
 header -->
@include('layouts.header')
@yield('content')
@include('layouts.footer')
@extends('layouts.modal')

<!--=================================
 header -->
<div class="car-top">
    <span><img src="{{asset('images/car.png')}}" alt=""></span>
</div>
<!--=================================
back to top -->
<!--=================================
 jquery -->
<!-- jquery  -->
<script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<!-- bootstrap -->
<script type="text/javascript" src="{{asset('js/popper.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- mega-menu -->
<script type="text/javascript" src="{{asset('js/mega-menu/mega_menu.js')}}"></script>
<!-- appear -->
<script type="text/javascript" src="{{asset('js/jquery.appear.js')}}"></script>
<!-- counter -->
<script type="text/javascript" src="{{asset('js/counter/jquery.countTo.js')}}"></script>
<!-- owl-carousel -->
<script type="text/javascript" src="{{asset('js/owl-carousel/owl.carousel.min.js')}}"></script>
<!-- select -->
{{--<script type="text/javascript" src="{{asset('js/select/jquery-select.js')}}"></script>--}}
<!-- magnific popup -->
<script type="text/javascript" src="{{asset('js/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<!-- phone mask -->
<script type="text/javascript" src="{{asset('js/jquery-ui.js')}}"></script>
<script type="text/javascript" src="{{asset('js/mask/global.js')}}"></script>
<script type="text/javascript" src="{{asset('js/mask/entrance.js')}}"></script>
<!-- custom -->
<script type="text/javascript" src="{{asset('js/custom.js')}}"></script>
<script>
    // if ($("body").height() < $(window).height())
    //     $("footer").addClass("fixed-bottom");
</script>
@if ($message = Session::get('success') or $message = Session::get('error') or $message = Session::get('warning') or $message = Session::get('info') or $errors->any())
    <script>
        (function ($) {
            $(function () {
                $('#messageModal').modal('show');
                setTimeout(function () {
                    $('#messageModal').modal('hide')
                }, 5000);
            });
        })(jQuery);
    </script>
@endif
@yield('scripts');
</body>
</html>
