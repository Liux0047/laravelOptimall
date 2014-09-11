<!DOCTYPE html>
<html lang='zh-Hans'>
<head>
    <meta charset="UTF-8">
    <meta name='keywords' content='目光之城，眼镜商城，网上配镜，在线配镜，眼镜，隐形眼镜，淘宝眼镜，天猫眼镜，眼镜团购，买眼镜' />
    <meta name='description' content="目光之城是全中国最IN的正品潮流眼镜网络商城，致力于为年轻人提供最时尚，最具性价比的眼镜以及最完美的网络配镜用户体验. 目光之城有海量超值眼镜和配镜相关的活动与信息，详情请登录目光之城官网：mgzc.net">    
    <meta name='token' content='{{ csrf_token() }}'/>
    @section('link-css')
    {{ HTML::style('css/bootstrap.min.css'); }}
    {{ HTML::style('plugins/font-awesome/css/font-awesome.min.css'); }}
    {{ HTML::style('css/yamm.css'); }}        
    {{ HTML::style('plugins/jQuery-mailtip/mailtip.css') }}
    <link rel='shortcut icon' type="image/x-icon" href="{{ asset('images/favicon.ico') }}"> 
    @show
    {{ HTML::style('css/style.css'); }}
    <title>{{{ $pageTitle or '目光之城 - 中国最IN的正品潮流眼镜商城，年轻潮人最爱，超高性价比，最佳网络配镜体验！'}}}</title>
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