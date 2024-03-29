<!DOCTYPE html>
<html lang='zh-Hans' xmlns:wb="http://open.weibo.com/wb">
<head>
    <meta charset="UTF-8">
    <meta name='keywords' content='目光之城，眼镜商城，网上配镜，在线配镜，眼镜，隐形眼镜，淘宝眼镜，天猫眼镜，眼镜团购，买眼镜'/>
    <meta name='description'
          content="目光之城是全国最IN的正品潮流眼镜网络商城，致力于为年轻人提供最时尚，最具性价比的眼镜以及最完美的网络配镜用户体验. 目光之城有海量超值眼镜和配镜相关的活动与信息，详情请登录目光之城官网：mgzc.net">
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


    <script>
        //baidu analytics - http://tongji.baidu.com/open/api/more?p=guide_overview
        var _hmt = _hmt || [];
    </script>
</head>


<body>
<noscript>
    <div class="alert alert-danger">
        <i class="fa fa-exclamation-circle"></i>
        为了正常显示页面，请打开您浏览器中的JavasScript脚本支持。您可以按照<a href="http://www.enable-javascript.com" target="_blank"> 该链接</a>
        提供的方式打开
    </div>

</noscript>
@if($isLessThanIE9)
    <div class="alert alert-error">
        为了更好的购物体验，我们推荐您更新目前使用的IE版本，或者使用最新的<a href="http://www.google.cn/intl/zh-CN/chrome/">Chrome</a>，<a
                href="se.360.cn">360浏览器</a>以及<a href="www.firefox.com.cn">火狐浏览器</a>
    </div>
@endif
@include('components.page-frame.top-banner')
@include('components.page-frame.navbar-customer')
@yield('content')
@include('components.page-frame.float-box')
@include('components.page-frame.footer')

@if (is_null(Cookie::get('hasVoted')))
    <!-- Vote Modal -->
    <div class="modal fade" id="vote_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h3>希望在镜架上激光刻字吗？请让我们知道您的想法吧</h3>

                    {{ HTML::image('images/background-images/laser-icon.png', 'laser-icon', array('height' => '10%')) }}

                    <div>
                        <span class="pull-left">赞 ({{ $voteForCount }}人)</span>
                        <span class="pull-right">踩 ({{ $voteAgainstCount }}人)</span>
                        <br>
                    </div>

                    <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped"
                             style="width: {{ $voteForCount / ($voteForCount + $voteAgainstCount) * 100 }}%">
                            <span class="sr-only">35% Complete (success)</span>
                        </div>
                        <div class="progress-bar progress-bar-warning progress-bar-striped"
                             style="width: {{ $voteAgainstCount / ($voteForCount + $voteAgainstCount) * 100 }}%">
                            <span class="sr-only">10% Complete (danger)</span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2">
                            <button type="button" class="btn btn-success btn-lg btn-block" onclick="vote(1);">
                                我想要
                            </button>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <button type="button" class="btn btn-warning btn-lg btn-block" onclick="vote(0);">没意思
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vote Modal -->
@endif

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

        @if(!App::environment('local'))
        //baidu analytics
        var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
        document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F97599e376911217c874380e476e60e0c' type='text/javascript'%3E%3C/script%3E"));
        @endif

        @if (is_null(Cookie::get('hasVoted')))
        $('#vote_modal').modal('show');

        function vote(isFor) {
            $('#vote_modal .modal-footer .btn').attr('disabled', true);
            $.ajax({
                type: "POST",
                url: "{{ action('VoteController@postVote') }}",
                data: {
                    is_for: isFor
                },
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='token']").attr('content'));
                },
                dataType: "json"
            }).done(function (data) {
                if (data.success == 1) {
                    $('#vote_modal .modal-body').slideUp(400, function () {
                        $('#vote_modal .modal-footer').html("<div class='col-md-6 col-md-offset-3'>" +
                        "<button type='button' class='btn btn-warning btn-lg btn-block' data-dismiss='modal'>关闭</button></div>");
                        $(this).html("<h3>感谢您的支持，我们会尽快推出您喜爱的产品</h3>");
                        $(this).slideDown();
                    });
                }
            }).fail(function () {

            }).always(function () {
                $('#vote_modal .modal-footer .btn').attr('disabled', false);
            });
        }
        @endif

    </script>
@show

</body>

</html>