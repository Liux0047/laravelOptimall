@extends ('layouts.base')

@section ('content')
<div class="container content-container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="login-container">
                <h4>
                    会员登录                        
                </h4>
                <hr> 
                {{ Form::open(array('url' => 'login')) }}
                <div class="form-group">
                    <input type="text" class="form-control" id="email" name="email" placeholder="邮箱地址">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="密码">
                    <p class="help-block pull-right">
                        <a href="{{ URL::to('forget-password') }}">
                            忘记密码?     
                        </a>
                    </p>
                </div>
                <div class="form-group">
                    <label class="checkbox-inline">
                        <input type="checkbox" id="remember_me" name="remember_me" value="1">
                        记住我                                
                    </label>
                </div>
                <br>
                <div class="control-group">
                    <div class="controls">
                        <a href="{{ URL::to('sign-up') }}" class="btn btn-primary btn-orange">
                            注册                                    
                        </a>
                        <input type="submit" class="btn btn-primary btn-green" value="登录">
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div><!--End Span6-->
    </div>
</div>
@stop

@section('script')
@parent
<script type="text/javascript">

</script> 
@stop