<!DOCTYPE html>
<html lang='zh-Hans'>
<head>
    <meta charset="UTF-8">
    <meta name='keywords' content='Optimall' />
    <meta name='token' content='{{ csrf_token() }}'/>
    @section('link-css')
    {{ HTML::style('css/bootstrap.min.css'); }}
    {{ HTML::style('plugins/font-awesome/css/font-awesome.min.css'); }}
    {{ HTML::style('css/yamm.css'); }}        
    {{ HTML::style('plugins/jQuery-mailtip/mailtip.css') }}
    <link rel='shortcut icon' type="image/x-icon" href="{{ asset('images/favicon.ico') }}"> 
    @show
    {{ HTML::style('css/style.css'); }}
    <title>{{{ $pageTitle or '目光之城眼镜商城'}}}</title>
</head>        


<body>    
    @include('components.page-frame.top-banner')                
    @include('components.page-frame.navbar-customer')
    @if(App::environment() != 'local')
    <div class="alert alert-danger align-center" role="alert">
        <h2>网站正在内测阶段，请勿购买<h2>
    </div>
    @endif
    @yield('content')
    @include('components.page-frame.footer')
</body>


@section('link-script')
{{ HTML::script('js/jquery.min.js') }}
{{ HTML::script('js/bootstrap.min.js') }}
{{ HTML::script('js/jquery.lazyload.min.js') }}
{{ HTML::script('plugins/jQuery-mailtip/jquery.mailtip.js') }}
{{ HTML::script('js/script.js') }}
@show


@section('script')
@include('components.page-frame.login-dropdown-js')
@include ('components.plugin.mailtip-js')
@show

</html>