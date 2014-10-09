<!DOCTYPE html>
<html lang='zh-Hans' xmlns:wb="http://open.weibo.com/wb">
<head>
    <meta charset="UTF-8">
    <meta name='keywords' content='目光之城，眼镜商城，网上配镜，在线配镜，眼镜，隐形眼镜，淘宝眼镜，天猫眼镜，眼镜团购，买眼镜' />
    <meta name='description' content="目光之城是全国最IN的正品潮流眼镜网络商城，致力于为年轻人提供最时尚，最具性价比的眼镜以及最完美的网络配镜用户体验. 目光之城有海量超值眼镜和配镜相关的活动与信息，详情请登录目光之城官网：mgzc.net">    
    <meta name='token' content='{{ csrf_token() }}'/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @section('link-css')
    {{ HTML::style('css/bootstrap.min.css'); }}
    {{ HTML::style('plugins/font-awesome/css/font-awesome.min.css'); }}
    {{ HTML::style('css/yamm.css'); }}        
    {{ HTML::style('plugins/jQuery-mailtip/mailtip.css') }}
    <link rel='shortcut icon' type="image/x-icon" href="{{ asset('images/favicon.ico') }}"> 
    @show
    {{ HTML::style('css/style.css'); }}

    @if($isLessThanIE9)
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    {{ HTML::script('js/html5shiv.min.js')}}
    {{ HTML::script('js/respond.min.js')}}
    <![endif]-->
    @endif
    <title>{{{ $pageTitle or '目光之城 - 最IN的正品潮流眼镜商城，年轻潮人最爱，超高性价比，最佳网络配镜体验！'}}}</title>  
</head>        


<body>
    @if($isLessThanIE9)
    <div class="alert alert-error">
        为了更好的购物体验，我们推荐您更新目前使用的IE版本，或者使用最新的<a href="http://www.google.cn/intl/zh-CN/chrome/">Chrome</a>，<a href="se.360.cn">360浏览器</a>以及<a href="www.firefox.com.cn">火狐浏览器
    </div>
    @endif
    @include('components.page-frame.top-banner')
    @include('components.page-frame.navbar-customer')
    @if(App::environment() != 'local' && !Cookie::has('internalTestWarning'))    
    <div class="modal fade" id="internal_test_warning">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">请勿购买</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger align-center" role="alert">
                        <h2>网站正在内测阶段，若未被邀请请勿购买</h2>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endif
    @yield('content')
    @include('components.page-frame.float-box')
    @include('components.page-frame.footer')
</body>


@section('link-script')
{{ HTML::script('js/jquery.min.js') }}
{{ HTML::script('js/bootstrap.min.js') }}
{{ HTML::script('js/jquery.lazyload.min.js') }}
{{ HTML::script('plugins/jQuery-mailtip/jquery.mailtip.js') }}
{{ HTML::script('js/script.js') }}
<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
@show


@section('script')
@include('components.page-frame.login-dropdown-js')
@include ('components.plugin.mailtip-js')
<script type="text/javascript">
@if(!App::environment('local') && !Cookie::has('internalTestWarning'))
$(document).ready(function() {
    $("#internal_test_warning").modal('show');
});
@endif

//baidu analytics
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F97599e376911217c874380e476e60e0c' type='text/javascript'%3E%3C/script%3E"));

</script>
@show

</html>