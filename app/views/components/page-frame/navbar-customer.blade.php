<div class="navbar navbar-default yamm navbar-inverse" id="nav">
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
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">所有产品<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="yamm-content">
                                <div class="row row-narrow">
                                    <div class="col-md-1 col-narrow">
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
                                        </ul>
                                    </div>
                                    <div class="col-md-1 col-narrow">
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
                                        </ul>
                                    </div>
                                    <div class="col-md-2">
                                        <ul>
                                            <li>
                                                <span class="category-header">颜色</span>
                                            </li>
                                        </ul>
                                        <div class="row row-narrow">
                                            <div class="col-md-6 col-narrow">
                                                <ul>
                                                    <li>
                                                        <a href="{{ url('gallery?colors[]=1') }}">
                                                            {{ HTML::image('images/color/color-2.png','', array('class'=>'color-icon')) }}
                                                            黑色  
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('gallery?colors[]=2') }}">
                                                            {{ HTML::image('images/color/color-13.png','', array('class'=>'color-icon')) }}
                                                            蓝色
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('gallery?colors[]=3') }}">
                                                            {{ HTML::image('images/color/color-20.png','', array('class'=>'color-icon')) }}
                                                            黄色
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('gallery?colors[]=4') }}">
                                                            {{ HTML::image('images/color/color-24.png','', array('class'=>'color-icon')) }}
                                                            红色
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('gallery?colors[]=5') }}">
                                                            {{ HTML::image('images/color/color-18.png','', array('class'=>'color-icon')) }}
                                                            豹纹
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('gallery?colors[]=6') }}">
                                                            {{ HTML::image('images/color/color-21.png','', array('class'=>'color-icon')) }}
                                                            棕色
                                                        </a>                                             
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('gallery?colors[]=7') }}">
                                                            {{ HTML::image('images/color/color-46.png','', array('class'=>'color-icon')) }}
                                                            灰色
                                                        </a>
                                                    </li>
                                                </ul>

                                            </div>
                                            <div class="col-md-6 col-narrow">
                                                <ul>
                                                    <li>
                                                        <a href="{{ url('gallery?colors[]=8') }}">
                                                            {{ HTML::image('images/color/color-47.png','', array('class'=>'color-icon')) }}
                                                            渐变
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('gallery?colors[]=9') }}">
                                                            {{ HTML::image('images/color/color-52.png','', array('class'=>'color-icon')) }}
                                                            粉色
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('gallery?colors[]=10') }}">
                                                            {{ HTML::image('images/color/color-58.png','', array('class'=>'color-icon')) }}
                                                            绿色
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('gallery?colors[]=11') }}">
                                                            {{ HTML::image('images/color/color-59.png','', array('class'=>'color-icon')) }}
                                                            紫色
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('gallery?colors[]=12') }}">
                                                            {{ HTML::image('images/color/color-60.png','', array('class'=>'color-icon')) }}
                                                            白色
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('gallery?colors[]=13') }}">
                                                            {{ HTML::image('images/color/color-64.png','', array('class'=>'color-icon')) }}
                                                            金色
                                                        </a>                                             
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-narrow navbar-poster">
                                        {{ HTML::image('images/navbar/2.jpg')}}
                                    </div>
                                    <div class="col-md-2 col-narrow navbar-poster">
                                        {{ HTML::image('images/navbar/3.jpg')}}
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown dropdown-hover">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">配镜须知<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="yamm-content content-narrow">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-bullhorn fa-fw"></i> 
                                            新手指南
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-credit-card fa-fw"></i> 
                                            支付相关
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-truck fa-fw"></i> 
                                            配送相关
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-gift fa-fw"></i> 
                                            关于商品
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-edit fa-fw"></i> 
                                            关于发票
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-phone fa-fw"></i> 
                                            售后服务
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-question-circle fa-fw"></i> 
                                            退换须知
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
                <li><a href="{{ action('InfoController@getAmbassadorIntro') }}">目光之星</a></li>
                <!-- Media Example -->
                <li class="dropdown dropdown-hover">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">中文<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="yamm-content">
                                <ul class="media-list">
                                    <li class="media"><a href="#" class="pull-right"><img src="http://placekitten.com/64/64/" alt="64x64" class="media-object"></a>
                                        <div class="media-body">
                                            <h4 class="media-heading">Media heading</h4>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante.
                                        </div>
                                    </li>
                                    <li class="media"><a href="#" class="pull-right"><img src="http://placekitten.com/64/64/" alt="64x64" class="media-object"></a>
                                        <div class="media-body">
                                            <h4 class="media-heading">Media heading</h4>
                                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Tables -->
                <li class="dropdown yamm-fullwidth dropdown-hover">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">中文<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="yamm-content">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Username</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Username</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td colspan="2">Larry the Bird</td>
                                            <td>@twitter</td>
                                            <td colspan="2">Larry the Bird</td>
                                            <td>@twitter</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Thumbnails demo -->
                <li class="dropdown dropdown-hover">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">中文<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="yamm-content">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="thumbnail"><img alt="260x130" src="http://placekitten.com/260/130/">
                                            <div class="caption">
                                                <h3>Thumb Label</h3>
                                                <p>Mazagran doppio half and half aftertaste organic, rich doppio</p>
                                                <p><a href="#" class="btn btn-primary">Action</a> <a href="#" class="btn btn-default">Action</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="thumbnail"><img alt="260x130" src="http://placekitten.com/260/130/">
                                            <div class="caption">
                                                <h3>Thumb Label</h3>
                                                <p>Black latte cinnamon, cultivar trifecta crema cappuccino</p>
                                                <p><a href="#" class="btn btn-primary">Action</a> <a href="#" class="btn btn-default">Action</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="thumbnail"><img alt="260x130" src="http://placekitten.com/260/130/">
                                            <div class="caption">
                                                <h3>Thumb Label</h3>
                                                <p>Bar roast et, as latte café au lait, mocha aromatic robusta</p>
                                                <p><a href="#" class="btn btn-primary">Action </a> <a href="#" class="btn btn-default">Action </a></p>
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
                    <a href="{{ action('MemberController@getLogout') }}">退出</a>
                </li>
                @else
                <!-- Forms -->
                <li class="dropdown" id="login-dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle"onclick="enableSubmit();">
                        登录 <b class="caret"></b>
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

