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
                <div class="container">
                    <h1 class="text-center">此处应是图片</h1>

                    <p class="text-center font-white">已参团人数： {{ $numJoined }}/1000</p>

                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
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
                        <a href="{{ action('MarketingController@getJoinTuan') }}" class="btn btn-danger btn-lg">我要参团</a>
                    </p>
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
                <div class="intro">
                    <h1>Example</h1>

                    <p>HTML markup example to define 4 sections.</p>
                </div>
            </div>
            <div class="section" id="section3">
                <div class="intro">
                    <h1>Working On Tablets</h1>

                    <p>
                        Designed to fit to different screen sizes as well as tablet and mobile devices.
                        <br/><br/><br/><br/><br/><br/>
                    </p>
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
                sectionsColor: ['#1bbc9b', '#4BBFC3', '#7BAABE', 'whitesmoke', '#ccddff'],
                anchors: ['firstPage', 'secondPage', '3rdPage', '4thpage', 'lastPage'],
                menu: '#menu',
                scrollingSpeed: 1000
            });

        });
    </script>

@stop

