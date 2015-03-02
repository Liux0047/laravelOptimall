@extends ('layouts.base')

@section('link-css')
    @parent
@stop

@section ('content')
    <div class="container content-container">
        <div class="page-header">
            @include('components.page-frame.message-bar')
            <h1>
                注册新会员
                <small>轻松一点，享受会员特权和及时优惠资讯</small>
            </h1>
        </div>

        <div class="row">
            <div class="col-md-4">
                {{ HTML::image('images/background-images/registration.jpg') }}
            </div>
            <div class="col-md-8">
                {{ Form::open(array('action' => 'MemberController@postMobileSignUp', 'role'=>'form', 'id'=>'registration_form',
                'novalidate'=>'novalidate', 'class'=>'form-horizontal')) }}
                <div class="form-group">
                    <label for="nickname" class="col-md-2 control-label">昵称*</label>

                    <div class="col-md-6">
                        <div>
                            <input type="text" class="form-control" id="nickname" name="nickname" placeholder="昵称"
                                   value="{{ Input::old('nickname') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mobile_number" class="col-md-2 control-label">手机号*</label>

                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-addon">+86</div>
                            <input type="text" class="form-control" id="mobile_number" name="mobile_number"
                                   placeholder="手机号" value="{{ Input::old('mobile_number') }}">
                        </div>
                        <span id="helpBlock" class="help-block">
                            或者使用 <a href="{{ action('MemberController@getSignUp') }}">邮箱注册</a>
                        </span>
                    </div>

                </div>
                <div class="form-group">
                    <label for="password" class="col-md-2 control-label">密码*</label>

                    <div class="col-md-6">
                        <div>
                            <input type="password" class="form-control" id="password" name="password" placeholder="密码">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm-password" class="col-md-2 control-label">确认密码*</label>

                    <div class="col-md-6">
                        <div>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                   placeholder="确认密码">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="verification_code" class="col-md-2 control-label"></label>

                    <div class="col-md-2">
                        <button class="btn btn-warning btn-block" id="verify_btn" onclick="sendVerificationCode();return false;"
                                @if (!Input::old('mobile_number')) disabled @endif>
                            获取验证码
                        </button>
                    </div>
                    <div class="col-md-4">
                        <div>
                            <input type="text" class="form-control" id="verification_code" name="verification_code"
                                   placeholder="请输入验证码">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-4">
                        <div class="checkbox">
                            <label for="show_ambassador_code">
                                <input type="checkbox" name="show_ambassador_code" id="show_ambassador_code"
                                       onchange="toggleAmbassadorCode();">
                                我被朋友邀请了
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group no-display" id="ambassador_code_container">
                    <label for="ambassador_code" class="col-md-2 control-label">邀请码</label>

                    <div class="col-md-6">
                        <div>
                            <input type="text" class="form-control" id="ambassador_code" name="ambassador_code"
                                   placeholder="请输入对方提供的邀请码" {{ Input::old('ambassador_code') }}>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-4">
                        <div class="checkbox">
                            <label for="agree_terms">
                                <input type="checkbox" name="agree_terms" id="agree_terms">
                                我同意
                                <a data-toggle="modal" data-target="#terms_modal">目光之城的协议和条款</a>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button type="submit" class="btn btn-primary">注册会员</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>


        <div class="modal fade" id="terms_modal" tabindex="-1" role="dialog" aria-labelledby="terms_modalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title">目光之城用户注册协议</h4>
                    </div>
                    <div class="modal-body">
                        @include('components.misc.terms-and-conditions')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal"
                                onclick="checkTermsAndConditions()">
                            同意
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>
@stop

@section("link-script")
    @parent
    {{ HTML::script('plugins/jQuery-Validation/jquery.validate.min.js') }}
    {{ HTML::script('js/jQuery-Validation-customize.js') }}
@stop

@section("script")
    @parent
    <script type="text/javascript">
        $(document).ready(function () {
            // validate signup form on keyup and submit
            var warningIcon = "<i class='fa fa-warning fa-lg'></i> ";
            $("#registration_form").validate({
                rules: {
                    nickname: {
                        required: true,
                        maxlength: 15
                    },
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
                    confirm_password: {
                        required: true,
                        equalTo: "#password"
                    },
                    verification_code: {
                        required: true,
                        minlength: 6
                    },
                    agree_terms: {
                        required: true
                    }
                },
                messages: {
                    nickname: {
                        required: warningIcon + "请输入您的昵称",
                        maxlength: warningIcon + "昵称不能超过15个字符"
                    },
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
                    confirm_password: {
                        required: warningIcon + "请再次输入新密码",
                        equalTo: warningIcon + "两次输入的密码不匹配"
                    },
                    verification_code: {
                        required: warningIcon + "请输入验证码",
                        minlength: warningIcon + "请输入验证码"
                    },
                    agree_terms: {
                        required: warningIcon + "请同意我们的条款"
                    }
                },
                errorElement: "span",
                errorPlacement: function (error, element) {
                    error.appendTo($(element).parent().parent().parent());
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

        function checkTermsAndConditions() {
            document.getElementById('agree_terms').checked = true;
        }

        function toggleAmbassadorCode() {
            $('#ambassador_code_container').toggle(300);
        }

        $('#terms_modal').on('show.bs.modal', function () {
            $('.modal-content').css('margin-top', $(window).height() * 0.15);
            $('.modal-body').css('height', $(window).height() * 0.5);
        });

        $('#mobile_number').on('input', function() {
            if ($(this).val().length == 11 ) {
                $('#verify_btn').attr('disabled', false);
            } else {
                $('#verify_btn').attr('disabled', true);
            }
        })

        function sendVerificationCode() {
            $('#verify_btn').attr('disabled', true);
            $('#verify_btn').html('发送中...');
            var mobileNumber = $('#mobile_number').val();

            $.ajax({
                type: "POST",
                url: "{{ action('MemberController@postSendVerificationCode') }}",
                data: {
                    mobile_number: mobileNumber
                },
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='token']").attr('content'));
                },
                dataType: "json"
            }).done(function (data) {

            }).fail(function () {

            }).always(function () {
                $('#verify_btn').attr('disabled', false);
                $('#verify_btn').html('再次获取');
            });
        }

    </script>
@stop
