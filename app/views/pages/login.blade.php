@extends ('layouts.base')

@section('link-css')
@parent
@stop

@section ('content')
<div id="login_container">
    <div class="container" >
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                @include('components.page-frame.message-bar')
                <div class="login-form-container">
                    <h4>
                        会员登录                        
                    </h4>
                    <hr> 
                    {{ Form::open(array('action' => 'MemberController@postLogin')) }}
                    <div class="form-group">
                        <input type="email" class="form-control mailtip-input" id="email" name="email" placeholder="邮箱地址" value="{{ Input::old('email') }}">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="密码">
                        <p class="help-block pull-right">
                            <a href="{{ action('RemindersController@getRemind') }}">
                                忘记密码?     
                            </a>
                        </p>
                    </div>
                    <div class="checkbox">
                        <label class="font-green">
                            <input type="checkbox" id="remember_me" name="remember_me" value="1" checked>
                            记住我                                
                        </label>
                    </div>
                    <a href="{{ URL::to('sign-up') }}" class="btn btn-danger pull-right">
                        注册                                    
                    </a>
                    <input type="submit" class="btn btn-metro" value="登录">
                    {{ Form::close() }}
                </div>
            </div><!--End Span6-->
        </div>
    </div>
</div>
@stop

@section('link-script')
@parent
@stop


@section('script')
@parent
@stop