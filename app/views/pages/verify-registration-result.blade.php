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
        @if ($isSuccessful)
        成功验证邮箱，页面将在3秒后自动跳转到主页
        @else
        验证失败
        @endif
    </p>
</div>
@stop

@section('script')
@parent
@if ($isSuccessful)
<script type="text/javascript">
var delay = 3000; //Your delay in milliseconds
setTimeout(function(){ 
    window.location = "{{ url('/') }}"
}, delay);
</script>
@endif
@stop