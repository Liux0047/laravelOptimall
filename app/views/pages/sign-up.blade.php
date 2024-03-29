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
                {{ Form::open(array('action' => 'MemberController@postSignUp', 'role'=>'form', 'id'=>'registration_form',
                'novalidate'=>'novalidate', 'class'=>'form-horizontal')) }}
                <div class="form-group">
                    <label for="nickname" class="col-md-2 control-label">昵称*</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" id="nickname" name="nickname" placeholder="昵称"
                               value="{{ Input::old('nickname') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-md-2 control-label">邮箱*</label>

                    <div class="col-md-6">
                        <input type="email" class="form-control mailtip-input" id="email" name="email" placeholder="邮箱"
                               value="{{ Input::old('email') }}">
                        <span id="helpBlock" class="help-block">
                            没有邮箱？使用 <a href="{{ action('MemberController@getMobileSignUp') }}">手机注册</a>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-md-2 control-label">密码*</label>

                    <div class="col-md-6">
                        <input type="password" class="form-control" id="password" name="password" placeholder="密码">
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm-password" class="col-md-2 control-label">确认密码*</label>

                    <div class="col-md-6">
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                               placeholder="确认密码">
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
                        <input type="text" class="form-control" id="ambassador_code" name="ambassador_code"
                               placeholder="请输入对方提供的邀请码" {{ Input::old('ambassador_code') }}>
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
                    email: {
                        required: true,
                        email: true,
                        maxlength: 50
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
                    agree_terms: {
                        required: true
                    }
                },
                messages: {
                    nickname: {
                        required: warningIcon + "请输入您的昵称",
                        maxlength: warningIcon + "昵称不能超过15个字符"
                    },
                    email: {
                        required: warningIcon + "请输入您的邮箱",
                        email: warningIcon + "请输入正确的邮箱",
                        maxlength: warningIcon + "邮箱长度不能超过50个字符"
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
                    agree_terms: {
                        required: warningIcon + "请同意我们的条款"
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

    </script>
@stop
