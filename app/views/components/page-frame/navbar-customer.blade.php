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
                                                <strong>材料</strong>
                                            </li>
                                            <li>
                                                <a href="#">超韧钨钢</a>                                                
                                            </li>
                                            <li>
                                                质感板材
                                            </li>
                                            <li>
                                                轻柔TR                                                
                                            </li>
                                            <li>
                                                商务金属                                                
                                            </li>
                                            <li>
                                                手造原木                                               
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-1 col-narrow">
                                        <ul>
                                            <li>
                                                <strong>风格</strong>
                                            </li>
                                            <li>
                                                英伦学院                                                
                                            </li>
                                            <li>
                                                户外阳光
                                            </li>
                                            <li>
                                                商务休闲                                                
                                            </li>
                                            <li>
                                                复刻经典                                                
                                            </li>
                                            <li>
                                                特立独行                                               
                                            </li>
                                            <li>
                                                摩登时代
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        {{ HTML::image('images/navbar/1.jpg')}}
                                    </div>
                                    <div class="col-md-4">
                                        {{ HTML::image('images/navbar/2.jpg')}}
                                    </div>
                                    <div class="col-md-2">
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
                            <div class="yamm-content">
                                <ul>
                                    <li>

                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
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
                    <a href="{{ URL::to('logout') }}">退出</a>
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
                <li><a href="{{ URL::to('sign-up') }}">注册</a></li>
                @endif
            </ul><!-- .nav .nav-right -->
        </div><!-- .nav-collpase -->
    </div><!-- container -->
</div><!-- .navbar -->

