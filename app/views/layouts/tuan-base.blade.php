<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>目光之城 大型团购活动</title>
    <meta name="author" content="Alvaro Trigo Lopez"/>
    <meta name="description"
          content="fullPage plugin by Alvaro Trigo. Create fullscreen pages fast and simple. One page scroll like iPhone website."/>
    <meta name="keywords" content="fullpage,jquery,alvaro,trigo,plugin,fullscren,screen,full,iphone5,apple"/>
    <meta name="Resource-type" content="Document"/>

    @section('link-css')
    {{ HTML::style('css/bootstrap.min.css'); }}
@show

    <style>

        .font-white {
            color: #FFFFFF;
        }
    </style>


</head>
<body>

@yield('content')

</body>

@section('link-script')
    {{ HTML::script('js/jquery.min.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
@show

@section('javascript')
@show
