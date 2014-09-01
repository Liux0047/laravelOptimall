<div class="navbar yamm navbar-default navbar-inverse" id="nav">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ asset('/') }}">目光之城</a> 
                </div>
                <div id="navbar-collapse-1" class="navbar-collapse navbar-responsive-collapse collapse">
                    <ul class="nav navbar-nav">
                        <!-- Classic list -->
                        <li class="dropdown dropdown-hover"><a href="#" data-toggle="dropdown" class="dropdown-toggle">所有宝贝</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <!-- Content container to add padding -->
                                    <div class="yamm-content">
                                        <div class="row row-union">
                                            <div class="col-sm-3"><a href="#" class="thumbnail"><img alt="150x190" src="http://placekitten.com/150/190/"></a></div>
                                            <ul class="col-sm-3 list-unstyled">

                                                <p><strong>材质</strong></p>
                                                <!--古代圣贤然后还有各个专业 加图片-->

                                                <li><a href="#">质感金属</a></li>
                                                <li><a href="#">超轻板材</a></li>
                                                <li><a href="#">轻盈钨钢</a></li>
                                                <li><a href="#">TR-90</a></li>

                                            </ul>
                                            <div class="col-xs-6 col-sm-3"><a href="#" class="thumbnail"><img alt="150x190" src="http://placekitten.com/150/190/"></a></div>
                                            <ul class="col-sm-3 list-unstyled">

                                                <p><strong>风格</strong></p>


                                                <li><a href="#">商务精英</a></li>
                                                <li><a href="#">休闲品位</a></li>
                                                <li><a href="#">潮流时尚</a></li>
                                                <li><a href="#">体验一下</a></li>
                                            </ul>

                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>


                        <!-- Classic dropdown -->
                        <li class="dropdown dropdown-hover"><a href="#" data-toggle="dropdown" class="dropdown-toggle">配镜需知</a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a tabindex="-1" href="#"><i class="fa fa-bolt"> </i>  关于商品 </a></li>
                                <li><a tabindex="-1" href="#"><i class="fa fa-rocket"> </i> 关于配送 </a></li>
                                <li><a tabindex="-1" href="#"><i class="fa fa-check-square"> </i> 关于订单 </a></li>
                                <li><a tabindex="-1" href="#"><i class="fa fa-trophy"> </i> 售后政策 </a></li>
                                <li><a tabindex="-1" href="#"><i class="fa fa-eraser"> </i> 退换商品 </a></li>
                                <li><a tabindex="-1" href="#"><i class="fa fa-location-arrow"> </i> 售后地址 </a></li>
                                <li><a tabindex="-1" href="#"><i class="fa fa-ticket"> </i> 关于发票 </a></li>
                                <li><a tabindex="-1" href="#"><i class="fa fa-tachometer"> </i> 眼镜保养 </a></li>
                                <li><a tabindex="-1" href="#"><i class="fa fa-tachometer"> </i> FAQ </a></li>
                            </ul>
                        </li>





                        <li class="dropdown dropdown-hover"><a href="#" data-toggle="dropdown" class="dropdown-toggle">特惠分享</a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a tabindex="-1" href="#"><i class="fa fa-bolt"> </i>  今日特惠  </a></li>
                                <li><a tabindex="-1" href="#"><i class="fa fa-bolt"> </i>  开学活动 </a></li>
                                <li><a tabindex="-1" href="#"><i class="fa fa-rocket"> </i> 验光补贴 </a></li>
                            </ul>
                        </li>

                        <!-- Accordion demo -->
                        <li class="dropdown dropdown-hover"><a href="#" data-toggle="dropdown" class="dropdown-toggle">联系我们</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="yamm-content">
                                        <div class="row row-category">
                                            <div id="accordion" class="panel-group">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">电子邮箱</a></h4>
                                                    </div>
                                                    <div id="collapseOne" class="panel-collapse collapse in">
                                                        <div class="panel-body">客服customer service：service@mgzc.net </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">公共主页</a></h4>
                                                    </div>
                                                    <div id="collapseTwo" class="panel-collapse collapse">
                                                        <div class="panel-body"><p>微信公共主页：123213133232</p><p> 人人公共主页：目光之城 </p></div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">墙外观众</a></h4>
                                                    </div>
                                                    <div id="collapseThree" class="panel-collapse collapse">
                                                        <div class="panel-body"><p> Facebook: </p> <p>Twitter</p><p>Pinterest</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        @if(Auth::check())
                        <li>
                            <a href="{{ URL::action('MemberAccountController@getShoppingHistory'); }}">
                                欢迎, {{ Auth::user()->nickname }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ URL::to('logout') }}">退出</a>
                        </li>
                        @else
                        <li class="dropdown" id="login_dropdown_control">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle" onclick="enableSubmit();">登录</a>
                            <div class="dropdown-menu dropdown-login">
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
                                            <a href="/optimall/forget-password.php">
                                                忘记密码?     
                                            </a>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" id="remember_me" name="remember_me">记住我
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
                        <li><a href="{{ URL::to('sign-up') }}">注册</a></li>
                        @endif
                    </ul>    
                </div><!-- /.nav-collapse -->
            </div><!-- /.navbar -->
        </div>
    </div>
</div>