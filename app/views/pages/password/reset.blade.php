@extends ('layouts.base')

@section ('content')
<div class="container content-container">
    <div class="page-header">
     
        <h1>重置您的密码</h1>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-10 col-md-offset-2">     
            @include('components.page-frame.message-bar')    
            {{ Form::open(array('action'=>'RemindersController@postReset', 'novalidate'=>'novalidate', 'class'=>'form-horizontal', 'id'=>'change_pwd_form')) }}
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
                <label for="email" class="col-md-2 control-label">您的邮箱</label>
                <div class="col-md-4">
                    <input type="email" class="form-control" id="email" name="email" placeholder="您的邮箱">
                </div>
            </div>                       
            <div class="form-group">
                <label for="password" class="col-md-2 control-label">新密码</label>
                <div class="col-md-4">
                    <input type="password" class="form-control" id="password" name="password" placeholder="新密码">
                </div>
            </div>
            <div class="form-group">
                <label for="password_confirmation" class="col-md-2 control-label">确认密码</label>
                <div class="col-md-4">
                    <input type="password" class="form-control" id="password_confirmation" onpaste="return false;" name="password_confirmation" placeholder="确认密码">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-4">
                    <input type="submit" class="btn btn-primary btn-sm pull-right" value="确认修改">                         
                </div>
            </div>                
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop


@section('link-script')
@parent
{{ HTML::script('plugins/jQuery-Validation/jquery.validate.min.js')}}
{{ HTML::script('js/jQuery-Validation-customize.js')}}
@stop

@section('script')
@parent
<script type="text/javascript">
$(document).ready(function() {
    // validate signup form on keyup and submit
    var warningIcon = "<i class='fa fa-warning fa-lg'></i> ";
    $("#change_pwd_form").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                passwordCheck: true,
                minlength: 6,
                maxlength: 16
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"
            }
        },
        messages: {
            email: {
                required: warningIcon + "请输入您的邮箱"
            },
            password: {
                required: warningIcon + "请输入新密码",
                passwordCheck: warningIcon + "请输入6-16位半角字符（必须包括数字，小写字母和大写字母）"
            },
            password_confirmation: {
                required: warningIcon + "请再次输入新密码",
                equalTo: warningIcon + "两次输入的密码不匹配"
            }
        },
        errorElement: "span",
        errorPlacement: function(error, element) {
            error.appendTo($(element).parent().parent());
        },
        success: function(label) {
            label.html("<span class='jq-validate-valid'><i class='fa fa-check-circle fa-lg'></i></span>");
        },
        validClass: "",
        errorClass: "jq-validate-error",
        ignore: [], //validate hidden input
        onkeyup: function(element) {
            $(element).valid();
        },
        onfocusout: function(element) {
            $(element).valid();
        },
        //onkeyup: true,
        //onfocusout: true,
        onclick: true
    });
});
</script> 
@stop