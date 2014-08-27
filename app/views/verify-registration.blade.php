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
        您注册的邮箱是：{{ $email }}                    
    </p>
    <p>
        请进入您注册的邮箱进行验证
    </p>
</div>
@stop