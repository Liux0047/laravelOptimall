<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>目光之城 大型团购活动</title>
    <meta name="author" content="Alvaro Trigo Lopez"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name='token' content='{{ csrf_token() }}'/>
    <meta name="description"
          content="fullPage plugin by Alvaro Trigo. Create fullscreen pages fast and simple. One page scroll like iPhone website."/>
    <meta name="keywords" content="fullpage,jquery,alvaro,trigo,plugin,fullscren,screen,full,iphone5,apple"/>
    <meta name="Resource-type" content="Document"/>

    @section('link-css')
        {{ HTML::style('css/bootstrap.min.css'); }}
    @show

    <style>

        body {
            font-size: 28px;
        }

        .font-white {
            color: #FFFFFF;
        }

        .font-red {
            color: #ee4054;
        }

        .second-col {
            margin-top: 0%;
        }

        .btn {
            background-color: #eeeeee !important;
            background-image: none !important;
            color: #555555 !important;
            text-shadow: 0 -1px transparent !important;
            font-weight: bold !important;
            font-size: 28px;
            padding: 22px 36px;
            border-radius: 8px;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif !important;
            -webkit-font-smoothing: antialiased !important;
            -moz-osx-font-smoothing: grayscale !important;
            font-family: "museo_sans", "Helvetica Neue", Helvetica, Arial, sans-serif !important;
            display: inline-block;
            border: none;
            -webkit-font-smoothing: antialiased;
            line-height: 18px;
            cursor: pointer;
            text-align: center;
            background-clip: border-box;
            transition: 0.1s ease-in !important;
            -webkit-box-shadow: inset 0 -16px 12px rgba(0, 0, 0, 0), inset 0 -2px 0 rgba(0, 0, 0, 0.1);
            -moz-box-shadow: inset 0 -16px 12px rgba(0, 0, 0, 0), inset 0 -2px 0 rgba(0, 0, 0, 0.1);
            box-shadow: inset 0 -16px 12px rgba(0, 0, 0, 0), inset 0 -2px 0 rgba(0, 0, 0, 0.1);
        }

        .btn-warning {
            background-color: #ff910f !important;
            background-image: none !important;
            color: #ffffff !important;
            text-shadow: 0 -1px transparent !important;
            font-weight: bold !important;
        }

        .btn-danger {
            background-color: #ee4054 !important;
            background-image: none !important;
            color: #ffffff !important;
            text-shadow: 0 -1px transparent !important;
            font-weight: bold !important;
        }

        label {
            font-size: 24px;
        }

        @media (min-device-width: 768px) {

            body {
                font-size: 14px;
            }

            .btn {
                font-size: 16px;
                padding: 11px 18px;
                border-radius: 4px;
            }

            label {
                font-size: 12px;
            }
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
