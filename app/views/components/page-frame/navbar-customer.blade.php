<div class="navbar navbar-default yamm" id="nav">
    <div class="container">
        <div class="navbar-header">
            <button type="button" data-toggle="collapse" data-target="#navbar-collapse-2" class="navbar-toggle">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{{ URL::to('/') }}" class="navbar-brand">首页</a>
        </div>
        <div id="navbar-collapse-2" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown dropdown-hover yamm-fw">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                        所有产品
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="yamm-content">
                                <div class="row row-narrow">
                                    <div class="col-md-1 col-sm-3 col-xs-3 col-narrow">
                                        <ul>
                                            <li>
                                                <span class="category-header">材料</span>
                                            </li>
                                            <li>
                                                <a href="{{ url('gallery?materials[]=1') }}">超韧钨钢</a>                                                
                                            </li>
                                            <li>
                                                <a href="{{ url('gallery?materials[]=2') }}">质感板材</a> 
                                            </li>
                                            <li>
                                                <a href="{{ url('gallery?materials[]=3') }}">轻柔TR</a>                                           
                                            </li>
                                            <li>
                                                <a href="{{ url('gallery?materials[]=4') }}">商务金属</a>                                              
                                            </li>
                                            <li>
                                                <a href="{{ url('gallery?materials[]=5') }}">手造原木</a>                                           
                                            </li>
                                            <li>
                                                <a href="{{ url('gallery?materials[]=6') }}">高雅尼龙</a>                                           
                                            </li>
                                            <li>
                                                <a href="{{ url('gallery') }}">
                                                    <i class="fa fa-angle-double-right"></i> 
                                                    更多
                                                </a>                                                    
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-1 col-sm-3 col-xs-3 col-narrow">
                                        <ul>
                                            <li>
                                                <span class="category-header">风格</span>
                                            </li>
                                            <li>
                                                <a href="{{ url('gallery?styles[]=1') }}">英伦学院</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('gallery?styles[]=2') }}">户外阳光</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('gallery?styles[]=3') }}">商务休闲</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('gallery?styles[]=4') }}">复刻经典</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('gallery?styles[]=5') }}">特立独行</a>                                             
                                            </li>
                                            <li>
                                                <a href="{{ url('gallery?styles[]=6') }}">摩登时代</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('gallery') }}">
                                                    <i class="fa fa-angle-double-right"></i> 
                                                    更多
                                                </a>                                                    
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-2 col-sm-6 col-xs-6">
                                        <ul>
                                            <li>
                                                <span class="category-header">颜色</span>
                                            </li>
                                        </ul>
                                        <div class="row row-narrow">
                                            <div class="col-md-6 col-sm-6 col-xs-6 col-narrow">
                                                <ul>
                                                    <li>
                                                        <a href="{{ url('gallery?colors[]=1') }}">
                                                            {{ HTML::image('images/color/base-color-icons/base-color-1.png','', array('class'=>'color-icon')) }}
                                                            黑色  
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('gallery?colors[]=2') }}">
                                                            {{ HTML::image('images/color/base-color-icons/base-color-2.png','', array('class'=>'color-icon')) }}
                                                            蓝色
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('gallery?colors[]=3') }}">
                                                            {{ HTML::image('images/color/base-color-icons/base-color-3.png','', array('class'=>'color-icon')) }}
                                                            黄色
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('gallery?colors[]=4') }}">
                                                            {{ HTML::image('images/color/base-color-icons/base-color-4.png','', array('class'=>'color-icon')) }}
                                                            红色
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('gallery?colors[]=5') }}">
                                                            {{ HTML::image('images/color/base-color-icons/base-color-5.png','', array('class'=>'color-icon')) }}
                                                            豹斑
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('gallery?colors[]=6') }}">
                                                            {{ HTML::image('images/color/base-color-icons/base-color-6.png','', array('class'=>'color-icon')) }}
                                                            棕色
                                                        </a>                                             
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('gallery?colors[]=7') }}">
                                                            {{ HTML::image('images/color/base-color-icons/base-color-7.png','', array('class'=>'color-icon')) }}
                                                            灰色
                                                        </a>
                                                    </li>
                                                </ul>

                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6 col-narrow">
                                                <ul>
                                                    <li>
                                                        <a href="{{ url('gallery?colors[]=8') }}">
                                                            {{ HTML::image('images/color/base-color-icons/base-color-8.png','', array('class'=>'color-icon')) }}
                                                            渐变
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('gallery?colors[]=9') }}">
                                                            {{ HTML::image('images/color/base-color-icons/base-color-9.png','', array('class'=>'color-icon')) }}
                                                            粉色
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('gallery?colors[]=10') }}">
                                                            {{ HTML::image('images/color/base-color-icons/base-color-10.png','', array('class'=>'color-icon')) }}
                                                            绿色
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('gallery?colors[]=11') }}">
                                                            {{ HTML::image('images/color/base-color-icons/base-color-11.png','', array('class'=>'color-icon')) }}
                                                            紫色
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('gallery?colors[]=12') }}">
                                                            {{ HTML::image('images/color/base-color-icons/base-color-12.png','', array('class'=>'color-icon')) }}
                                                            白色
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('gallery?colors[]=13') }}">
                                                            {{ HTML::image('images/color/base-color-icons/base-color-13.png','', array('class'=>'color-icon')) }}
                                                            金色
                                                        </a>                                             
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('gallery?colors[]=13') }}">
                                                            {{ HTML::image('images/color/base-color-icons/base-color-14.png','', array('class'=>'color-icon')) }}
                                                            豹纹
                                                        </a>                                             
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-9 col-xs-9 col-narrow navbar-poster">
                                        <a href="{{ action('ProductController@getProduct', array(2008)) }}">
                                            {{ HTML::image('images/navbar/nav-poster-1.jpg')}}
                                        </a>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-xs-3 col-narrow navbar-poster">
                                        <a href="{{ action('ProductController@getProduct', array(3004)) }}">
                                            {{ HTML::image('images/navbar/nav-poster-2.jpg')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown dropdown-hover">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                        配镜须知
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ url('info/beginner-guide') }}">
                                <i class="fa fa-bullhorn fa-fw"></i> 
                                新手指南
                            </a>
                        </li>
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
                                退换须知
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown dropdown-hover">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                        精选集
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ url('/'.'#promotion-section') }}">
                                促销
                                <span class="pill">{{ HTML::image('images/section-tags/section-tag-1.png') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/'.'#best-seller-section') }}">
                                热卖
                                <span class="pill">{{ HTML::image('images/section-tags/section-tag-2.png') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/'.'#new-arrival-section') }}">
                                新品
                                <span class="pill">{{ HTML::image('images/section-tags/section-tag-3.png') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/'.'#featured-section') }}">
                                推荐
                                <span class="pill">{{ HTML::image('images/section-tags/section-tag-4.png') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/'.'#classical-section') }}">
                                经典
                                <span class="pill">{{ HTML::image('images/section-tags/section-tag-5.png') }}</span>
                            </a>
                        </li>  
                    </ul>
                </li>
                <li class="dropdown dropdown-hover">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                        眼镜知识 
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ action('InfoController@getMeasurePupilDistance') }}">
                                如何测量瞳距
                            </a>
                        </li>
                        <li>
                            <a href="{{ action('InfoController@getChooseFrame') }}">
                                选择合适的镜框
                            </a>
                        </li>
                        <li>
                            <a href="{{ action('InfoController@getAboutPrescription') }}">
                                如何填写验光单
                            </a>
                        </li> 
                    </ul>
                </li>
                <li><a href="{{ action('InfoController@getAmbassadorIntro') }}">目光之星</a></li>
                <!-- contact us -->
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">联系我们</a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="yamm-content">
                                <ul>
                                    <li>
                                        <wb:follow-button uid="5281852072" type="red_3" width="240px" height="24" ></wb:follow-button> 
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <h6>
                                            <i class="fa fa-weixin fa-lg font-green"></i> 微信公共平台
                                        </h6>
                                        {{ HTML::image('images/icons/wechat.jpg') }}
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                <li class="dropdown dropdown-hover">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                        欢迎, {{ Auth::user()->nickname }}
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ URL::action('MemberAccountController@getShoppingHistory'); }}">
                                <i class="fa fa-book fa-fw"></i> 已购买的商品
                            </a>
                        </li>
                        <li>
                            <a href="{{ action('MemberAccountController@getSecurity') }}">
                                <i class="fa fa-gear fa-fw"></i> 安全设置
                            </a>
                        </li>
                        <li>
                            <a href="{{ action('MemberAccountController@getMyPrescription') }}">
                                <i class="fa fa-table fa-fw"></i> 我的验光单
                            </a>
                        </li>  
                        <li>
                            <a href="{{ action('MemberAccountController@getAmbassadorPanel') }}">
                                <i class="fa fa-star fa-fw"></i> 目光之星
                            </a>
                        </li>      
                        <li class="divider"></li>
                        <li>
                            <a href="{{ action('MemberController@getLogout') }}">
                                <i class="fa fa-sign-out fa-fw"></i> 退出
                            </a>
                        </li> 
                    </ul>
                </li>                
                @else
                <!-- Forms -->
                <li class="dropdown" id="login_dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle"onclick="enableSubmit();">
                        登录 
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="yamm-content">
                                <form role="form" id="login_form">
                                    <h4>会员登录
                                        <small>(或<a href="{{ URL::to('sign-up') }}">创建账号)</a></small> 
                                    </h4>
                                    <hr>                    
                                    <div id="login_fail_container" class="no-display">
                                        <div class="alert alert-danger" id="login_fail_alert">
                                            登陆账号或密码不正确，请重新尝试                        
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope fa-fw fa-lg"></i></span>
                                            <input type="text" class="form-control" id="login_email" onkeyup="enableSubmit();" name="login_email" placeholder="邮箱地址">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock fa-fw fa-lg"></i></span>
                                            <input type="password" class="form-control" id="login_password" onkeyup="enableSubmit();" name="login_password" placeholder="密码">
                                        </div>
                                        <p class="help-block pull-right">
                                            <a href="{{ action('RemindersController@getRemind') }}">
                                                忘记密码?     
                                            </a>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" id="remember_me" name="remember_me" checked>记住我
                                        </label>
                                    </div>
                                    <div class="pull-right">
                                        {{ HTML::image('images/preloader.gif','', array('id'=>'login_preloader_img', 'class'=>'ajax-preloader no-display')) }}

                                        <button onclick="auth_login()" class="btn btn-primary btn-sm" id="login_submit" disabled="true">                   
                                            登录                    
                                        </button>          
                                    </div>
                                    <div class="clearfix"></div>    
                                </form>   
                            </div>
                        </li>                        
                    </ul>
                </li>
                <li><a href="{{ action('MemberController@getSignUp') }}">注册</a></li>
                @endif
            </ul><!-- .nav .nav-right -->
        </div><!-- .nav-collpase -->
    </div><!-- container -->
</div><!-- .navbar -->

