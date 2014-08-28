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
        成功验证邮箱
        @else
        验证失败
        @endif

    </p>
</div>
@stop