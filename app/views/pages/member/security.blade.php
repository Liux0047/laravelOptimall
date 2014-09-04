@extends ('layouts.base')

@section ('content')
<div class="container content-container">
    <div class="page-header">
        <h1>我的目光之城                    
            <small>安全设置</small>
        </h1>
    </div>
    <div class="row">
        @include('components.member-account.side-nav', array('entry'=>2))

        <div class="col-xs-12 col-md-10">         
            @include('components.page-frame.message-bar')
            {{ Form::open(array('action'=>'MemberAccountController@postChangePassword', 'novalidate'=>'novalidate', 'class'=>'form-horizontal', 'id'=>'change_pwd_form')) }}
                <div class="form-group">
                    <label for="current_password" class="col-md-2 control-label">当前密码</label>
                    <div class="col-md-4">
                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="当前密码">
                    </div>
                </div>                        
                <div class="form-group">
                    <label for="new_password" class="col-md-2 control-label">新密码</label>
                    <div class="col-md-4">
                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="新密码">
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm_password" class="col-md-2 control-label">确认密码</label>
                    <div class="col-md-4">
                        <input type="password" class="form-control" id="confirm_password" onpaste="return false;" name="confirm_password" placeholder="确认密码">
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
            current_password: {
                required: true
            },
            new_password: {
                required: true,
                passwordCheck: true,
                minlength: 6,
                maxlength: 16
            },
            confirm_password: {
                required: true,
                equalTo: "#new_password"
            }
        },
        messages: {
            current_password: {
                required: warningIcon + "请输入当前密码"
            },
            new_password: {
                required: warningIcon + "请输入新密码",
                minlength: warningIcon + "密码至少需要6位",
                passwordCheck: warningIcon + "密码必须包括至少一个数字和字母，且不能有其他字符",
                maxlength: warningIcon + "密码最多20位"
            },
            confirm_password: {
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