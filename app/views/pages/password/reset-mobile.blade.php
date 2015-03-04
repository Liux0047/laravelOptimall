@extends ('layouts.base')

@section ('content')
    <div class="container content-container">
        <div class="page-header">

            <h1>重置您的密码</h1>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-2">
                @include('components.page-frame.message-bar')
                {{ Form::open(array('action'=>'RemindersController@postResetMobile', 'novalidate'=>'novalidate', 'class'=>'form-horizontal', 'id'=>'change_pwd_form')) }}
                <input type="hidden" name="verification_code" value="{{ $verificationCode }}">

                <div class="form-group">
                    <label for="mobile_number" class="col-md-2 control-label">您的手机</label>

                    <div class="col-md-4">
                        <input type="text" class="form-control" id="mobile_number" name="mobile_number"
                               placeholder="您的手机号码">
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
                        <input type="password" class="form-control" id="password_confirmation" onpaste="return false;"
                               name="password_confirmation" placeholder="确认密码">
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
        $(document).ready(function () {
            // validate signup form on keyup and submit
            var warningIcon = "<i class='fa fa-warning fa-lg'></i> ";
            $("#change_pwd_form").validate({
                rules: {
                    mobile_number: {
                        required: true,
                        digits: true,
                        minlength: 11,
                        maxlength: 11
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
                    mobile_number: {
                        required: warningIcon + "请输入您的手机号码",
                        digits: warningIcon + "请输入正确的手机号码",
                        minlength: warningIcon + "请输入正确的手机号码",
                        maxlength: warningIcon + "请输入正确的手机号码"
                    },
                    password: {
                        required: warningIcon + "请输入新密码",
                        minlength: warningIcon + "密码至少需要6位",
                        passwordCheck: warningIcon + "密码必须包括至少一个数字和字母，且不能有其他字符",
                        maxlength: warningIcon + "密码最多20位"
                    },
                    password_confirmation: {
                        required: warningIcon + "请再次输入新密码",
                        equalTo: warningIcon + "两次输入的密码不匹配"
                    }
                },
                errorElement: "span",
                errorPlacement: function (error, element) {
                    error.appendTo($(element).parent().parent());
                },
                success: function (label) {
                    label.html("<span class='jq-validate-valid'><i class='fa fa-check-circle fa-lg'></i></span>");
                },
                validClass: "",
                errorClass: "jq-validate-error",
                ignore: [], //validate hidden input
                onkeyup: function (element) {
                    $(element).valid();
                },
                onfocusout: function (element) {
                    $(element).valid();
                },
                //onkeyup: true,
                //onfocusout: true,
                onclick: true
            });
        });
    </script>
@stop