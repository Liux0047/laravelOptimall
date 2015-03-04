@extends ('layouts.base')

@section ('content')
    <div class="container content-container">
        <div class="page-header">
            <h1>
                忘记密码
                <small>重置您的密码</small>
            </h1>
        </div>
        <div class="col-md-6">
            @include('components.page-frame.message-bar')
            <ul class="nav nav-tabs">
                <li class="active"><a href="#email_method" data-toggle="tab" aria-expanded="true">通过邮箱</a></li>
                <li class=""><a href="#mobile_method" data-toggle="tab" aria-expanded="false">通过手机</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="email_method">
                    <h4>
                        请输入您的邮箱地址，并通过您的邮箱重置密码
                    </h4>
                    <br>
                    {{ Form::open(array('action' => 'RemindersController@postRemind', 'id'=>'forget-pwd-form', 'role'=>'form'))}}
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope fa-fw fa-lg"></i></span>
                            <input type="email" class="form-control mailtip-input" id="email" name="email"
                                   placeholder="邮箱地址">
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary btn-sm pull-right" value="发送至此邮箱">
                    {{ Form::close() }}
                </div>

                <div class="tab-pane fade" id="mobile_method">
                    <h4>
                        请输入您的手机号码，并通过手机验证重置密码
                    </h4>
                    <br>
                    {{ Form::open(array('action' => 'RemindersController@postRemindMobile', 'id'=>'forget-pwd-form-mobile',
                    'role'=>'form'))}}
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-mobile fa-fw fa-lg"></i></span>
                            <input type="text" class="form-control" id="mobile_number"
                                   name="mobile_number" placeholder="手机号码">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="verification_code" class="control-label"></label>

                        <div class="row">
                            <div class="col-md-3">
                                <button class="btn btn-warning btn-block" id="verify_btn"
                                        onclick="sendVerificationCode();return false;"
                                @if (!Input::old('mobile_number')) disabled @endif>
                                    获取验证码
                                </button>
                            </div>
                            <div class="col-md-4">
                                <div>
                                    <input type="text" class="form-control" id="verification_code"
                                           name="verification_code"
                                           placeholder="请输入验证码">
                                </div>
                            </div>
                        </div>

                    </div>

                    <input type="submit" class="btn btn-primary btn-sm pull-right" value="重置密码">
                    {{ Form::close() }}
                </div>

            </div>


        </div>

    </div>
@stop

@section('script')
    <script>
        $('#mobile_number').on('input', function () {
            if ($(this).val().length == 11) {
                $('#verify_btn').attr('disabled', false);
            } else {
                $('#verify_btn').attr('disabled', true);
            }
        });

        function sendVerificationCode() {
            $('#verify_btn').attr('disabled', true);
            $('#verify_btn').html('发送中...');
            var mobileNumber = $('#mobile_number').val();

            $.ajax({
                type: "POST",
                url: "{{ action('RemindersController@postSendVerificationCode') }}",
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