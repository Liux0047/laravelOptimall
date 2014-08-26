<!DOCTYPE html>
<html lang='zh-Hans'>
    @section('head')
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
        <meta name='keywords' content='Optimall' />
        @section('link-css')
        {{ HTML::style('css/bootstrap.min.css'); }}
        {{ HTML::style('plugins/font-awesome/css/font-awesome.min.css'); }}
        {{ HTML::style('css/animate.min.css'); }}
        {{ HTML::style('css/yamm.css'); }}
        {{ HTML::style('css/style.css'); }}
        <link rel='shortcut icon' type="image/x-icon" href="{{ asset('image/favicon.ico') }}"> 
        @show
        <title>{{{ $pageTitle or '目光之城眼镜商城'}}}</title>
    </head>        


    <body>
        @section('top-banner')
        @show        
        @yield('navbar')
        @yield('content')
        @include('components.page-frame.footer')
    </body>


    @section('link-script')
    {{ HTML::script('js/jquery.min.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/jquery.lazyload.min.js') }}
    {{ HTML::script('js/script.js') }}
    @show

    @yield('script')
    
</html>