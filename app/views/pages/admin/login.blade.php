@extends ('layouts.admin-base')

@section ('content')
<div class="container content-container content-no-header">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @include('components.page-frame.message-bar')
            <div class="login-container">
                <h4>
                    管理员登陆                              
                </h4>
                <hr> 
                {{ Form::open(array('action' => 'AdminController@postLogin')) }}
                <div class="form-group">
                    <input type="text" class="form-control" id="username" name="username" placeholder="用户名">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="密码">
                </div>
                {{ Form::submit('登陆', array('class' => 'btn btn-primary')) }}
                
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