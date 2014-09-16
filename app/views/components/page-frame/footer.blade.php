<footer id="footer">
    <div class="container">
        <div class="row sections">
            <div class="col-sm-3">
                <div class="post">                    
                    <img src="{{ asset(Config::get('optimall.lazyloadImg')) }}" data-original="{{ asset('images/icons/crossroads.png') }}" class="lazy">
                    <h3 class="footer-header">
                        购物指南
                    </h3>
                </div>
                <div class="post">
                    <i class="fa fa-users fa-3x fa-fw"></i> 
                    <a href="{{ action('MemberController@getSignUp') }}" class="title">注册会员</a>
                    <p>加入最IN最潮流的时尚眼镜平台</p>
                </div>
                <div class="post">
                    <i class="fa fa-gift fa-3x fa-fw"></i> 
                    <a href="{{ url('info/beginner-guide') }}" class="title">购物流程</a>
                    <p>最佳用户体验， Click. Click. Done!</p>
                </div>
                <div class="post">
                    <i class="fa fa-question-circle fa-3x fa-fw"></i> 
                    <a href="{{ url('info/about-shoppings#faq') }}" class="title">常见问题</a>
                    <p>为您解惑，为您服务</p>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="post">
                    <img src="{{ asset(Config::get('optimall.lazyloadImg')) }}" data-original="{{ asset('images/icons/compose.png') }}" class="lazy">
                    <h3 class="footer-header">
                        配镜须知
                    </h3>
                </div>
                <ul>
                    <li>
                        <a href="{{ url('info/about-shoppings') }}">
                            <i class="fa fa-edit fa-fw"></i> 
                            关于发票
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('info/about-shoppings#payment') }}">
                            <i class="fa fa-credit-card fa-fw"></i> 
                            支付相关
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('info/about-shoppings#delivery') }}">
                            <i class="fa fa-truck fa-fw"></i> 
                            配送相关
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('info/about-products') }}">
                            <i class="fa fa-gift fa-fw"></i> 
                            关于商品
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('info/about-products#gouwubaozhang-1') }}">
                            <i class="fa fa-phone fa-fw"></i> 
                            售后服务
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('info/about-products#gouwubaozhang-2') }}">
                            <i class="fa fa-refresh fa-fw"></i> 
                            退货须知
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-3">
                <div class="post">
                    <img src="{{ asset(Config::get('optimall.lazyloadImg')) }}" data-original="{{ asset('images/icons/smartphone.png') }}" class="lazy">
                    <h3 class="footer-header ">
                        关于我们
                    </h3>
                </div>                                
                <div class="post">                    
                    <i class="fa fa-envelope fa-3x fa-fw"></i> 
                    <a href="#" class="title">
                        邮箱
                    </a>
                    <p>mgzcecommerce@163.com</p>
                </div>
                <div class="post">
                    <i class="fa fa-weibo fa-3x fa-fw"></i> 
                    <a href="http://www.weibo.com/u/5281852072" class="title">                        
                        目光之城官微 
                    </a>
                    <p><a href="http://www.weibo.com/u/5281852072">点击关注</a></p>
                </div>
                <div class="post">                    
                    <i class="fa fa-weixin fa-3x fa-fw"></i> 
                    <a href="{{ action('InfoController@getWechat')}}" class="title">
                        微信公共平台
                    </a>
                    <p><a href="{{ action('InfoController@getWechat')}}">点击查看二维码</a></p>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="post">
                    <img src="{{ asset(Config::get('optimall.lazyloadImg')) }}" data-original="{{ asset('images/icons/lightbulb.png') }}" class="lazy">
                    <h3 class="footer-header">
                        时尚周边
                    </h3>
                </div>
                <ul>
                    <li>
                        <a href="{{ action('InfoController@getAmbassadorIntro') }}">
                            成为目光之星
                        </a>
                    </li>
                    <li>
                        <a href="{{ action('InfoController@getMeasurePupilDistance') }}">
                            如何优雅地测量瞳距
                        </a>
                    </li>
                    <li>
                        <a href="{{ action('InfoController@getChooseFrame') }}">
                            如何优雅地选择镜框
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            如何优雅地筛选眼镜
                        </a>
                    </li>
                    <li>
                        <a href="{{ action('MemberAccountController@getMyPrescription') }}">
                            我的验光单
                        </a>
                    </li>
                </ul>
            </div>

        </div>
        <div class="row social-icons">
            <div class="col-md-12">
                <a href="{{ action('InfoController@getWechat')}}">
                    <i class="fa fa-weixin fa-2x"></i>
                </a>
                <a href="http://www.weibo.com/u/5281852072">
                    <i class="fa fa-weibo fa-2x"></i>
                </a>
                <a href="#">
                    <i class="fa fa-qq fa-2x"></i>
                </a>
                <a href="#">
                    <i class="fa fa-renren fa-2x"></i>
                </a>
                <a href="#">
                    <i class="fa fa-facebook-square fa-2x"></i>
                </a>
                <a href="#">
                    <i class="fa fa-twitter fa-2x"></i>
                </a>
            </div>
        </div>


        <div class="row copyright">
            <div class="col-md-12">
                © Copyright 2012-2014 All Rights Reserved. Designed by MuHen Ecommerce. 苏ICP编号：14006372号
            </div>
        </div>
    </div>
</footer>