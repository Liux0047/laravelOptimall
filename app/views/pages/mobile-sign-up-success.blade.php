@extends ('layouts.base')

@section ('content')
    <div class="container content-container">
        <div class="page-header">
            <h1>
                注册成功
                <small>恭喜您成为目光之城的会员</small>
            </h1>
        </div>
        <p>
            注册成功，页面将在3秒后自动跳转到主页
        </p>
    </div>
@stop

@section('script')
    @parent
    <script type="text/javascript">
        var delay = 3000; //Your delay in milliseconds
        setTimeout(function () {
            window.location = "{{ url('/') }}"
        }, delay);
    </script>
@stop