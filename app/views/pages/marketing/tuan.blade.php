@extends ('layouts.tuan-base')


@section('link-css')
    @parent
    {{ HTML::style('plugins/fullPage/jquery.fullPage.css') }}
@stop


@section ('content')
    @if ($isVerified)
        <div class="container">
            <h4>恭喜您验证成功</h4>

        </div>
    @else
        <div id="fullpage">
            <div class="section " id="section0">

                <div class="row">

                    <div class="col-lg-6">
                        <img src="{{ asset('images/marketing/school_days.jpg') }}" style="width: 70%">
                    </div>

                    <div class="col-lg-6" style="margin-top: 10%;">
                        <p class="text-center font-red">已参团人数： {{ $numJoined }}/1000</p>
                        <div class="row">
                            <div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2 col-xs-8 col-xs-offset-2">
                                <div class="progress progress-striped">
                                    @if ($numJoined > 200)
                                        <div class="progress-bar progress-bar-success" style="width: 20%"></div>
                                    @else
                                        <div class="progress-bar progress-bar-success"
                                             style="width: {{ $numJoined/10 }}%"></div>
                                    @endif

                                    @if ($numJoined > 500)
                                        <div class="progress-bar progress-bar-warning" style="width: 30%"></div>
                                    @else
                                        <div class="progress-bar progress-bar-warning"
                                             style="width: {{ ($numJoined - 200)/10 }}%"></div>
                                    @endif

                                    @if ($numJoined >= 1000)
                                        <div class="progress-bar progress-bar-danger" style="width: 50%"></div>
                                    @else
                                        <div class="progress-bar progress-bar-danger"
                                             style="width: {{ ($numJoined - 500)/10 }}%"></div>
                                    @endif

                                </div>
                            </div>
                        </div>


                        <p class="text-center">
                            <button onclick="$.fn.fullpage.moveTo(3);" class="btn btn-danger btn-lg">我要参团</button>
                        </p>
                    </div>
                </div>
            </div>

            <div class="section" id="section1">
                <div class="slide">
                    <div class="intro">
                        <h1>Create Sliders</h1>

                        <p>Not only vertical scrolling but also horizontal scrolling. With fullPage.js you will be able
                            to
                            add
                            horizontal sliders in the most simple way ever.</p>
                    </div>

                </div>
                <div class="slide">
                    <div class="intro">
                        <h1>Simple</h1>

                        <p>Easy to use. Configurable and customizable.</p>
                    </div>
                </div>
                <div class="slide">
                    <div class="intro">

                        <h1>Cool</h1>

                        <p>It just looks cool. Impress everybody with a simple and modern web design!</p>
                    </div>
                </div>
                <div class="slide">
                    <div class="intro">

                        <h1>Compatible</h1>

                        <p>Working in modern and old browsers too! IE 8 users don't have the fault of using that
                            horrible
                            browser! Lets give them a chance to see your site in a proper way!</p>
                    </div>
                </div>
            </div>

            <div class="section" id="section2">
                <div class="container">
                    <h4>加入团购活动</h4>

                    <div class="alert alert-warning" style="display: none" id="message_box">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="fa fa-exclamation-circle"></i>
                        <span id="message"></span>
                    </div>

                    <hr>
                    {{ Form::open(array('action' => 'MarketingController@postJoinTuan')) }}

                    <div class="form-group">
                        <label for="phone_number">请输入手机号码</label>

                        <input type="text" class="form-control" value="" maxlength="11" name="phone_number"
                               id="phone_number"/>
                    </div>


                    <p class="text-center">
                        <button class="btn" disabled id="submit_btn" onclick="submitForm();">
                            获取验证码
                        </button>
                    </p>

                    {{ Form::close() }}

                </div>
            </div>
        </div>
    @endif
@stop


@section('link-script')
    @parent
    {{ HTML::script('plugins/fullPage/jquery.fullPage.min.js') }}
    {{ HTML::script('js/jquery-ui.min.js') }}
@stop

@section('javascript')

    <script type="text/javascript">
        $(document).ready(function () {
            $('#fullpage').fullpage({
                sectionsColor: ['#F5D67C', '#4BBFC3', '#7BAABE',],
                anchors: ['poster', 'info', 'join'],
                menu: '#menu',
                scrollingSpeed: 1000,
                verticalCentered: false
            });

        });

        $('#phone_number').on('input', function (e) {
            if ($(this).val().length == 11) {
                $('#submit_btn').attr('disabled', false);
            } else {
                $('#submit_btn').attr('disabled', true);
            }
        });

        //prevent form submit
        $("form").submit(function (e) {
            e.preventDefault();
        });

        // Ajax to query for valid phone number
        function submitForm() {
            var phoneNumber = $('#phone_number').val();
            $.ajax({
                type: "POST",
                url: "{{ action('MarketingController@postJoinTuan') }}",
                data: {
                    phone_number: phoneNumber
                },
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='token']").attr('content'));
                },
                dataType: "json"
            }).done(function (data) {
                if (data.isValid == 'true') {
                    //window.location.href = "{{ action('MarketingController@getVerifyTuan') }}";
                } else {
                    $('#message_box #message').html(data.message);
                    $('#message_box').slideDown();
                }
            }).fail(function () {

            }).always(function () {

            });
        }

    </script>

@stop

