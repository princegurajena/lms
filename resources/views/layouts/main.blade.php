<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="{{asset('images/logo.png')}}" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/logo.png')}}" />
    <!-- Generated: 2018-04-16 09:29:05 +0200 -->
    <title>{{config('app.name','Agribank Leave'."|".$title)}}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <!-- c3.js Charts Plugin -->
    <link href="  {{asset('assets/plugins/charts-c3/plugin.css')}}" rel="stylesheet" />
    <link href="  {{asset('assets/css/dashboard.css')}}" rel="stylesheet" />


    @yield('css')
</head>

<body class="">
<div class="page">
    <div class="page-main">
       @include('includes.header')
        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
            <div class="container">
                <div class="row align-items-center">

                    @include('includes.nav')
                </div>
            </div>
        </div>
        <div class="my-3 my-md-5">
            <div class="container">
                @yield('content')
            </div>
        </div>
    </div>

</div>
@include('includes.footer')
</body>


<script src="  {{asset('assets/js/dashboard.js')}}"></script>

<script src="  {{asset('assets/plugins/charts-c3/plugin.js')}}"></script>
<script src="{{asset('js/chartjs.js')}}"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
<script src="https://cdn.jsdelivr.net/npm/fusioncharts@3.12.2/fusioncharts.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js" charset="utf-8"></script>
<script src="https://cdn.jsdelivr.net/npm/frappe-charts@1.1.0/dist/frappe-charts.min.iife.js"></script>
<!-- Google Maps Plugin -->
<link href="    {{asset('assets/plugins/maps-google/plugin.css')}}" rel="stylesheet" />
<script src="    {{asset('assets/plugins/maps-google/plugin.js')}}"></script>
<!-- Input Mask Plugin -->

<script src="    {{asset('assets/plugins/input-mask/plugin.js')}}"></script>
<script src="{{asset('assets/js/require.min.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
<script>
    requirejs.config({
        baseUrl: '.'
    });
</script>
<!-- Dashboard Core -->
@yield('js')
</html>
