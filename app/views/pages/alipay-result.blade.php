@extends ('layouts.base')

@section ('content')
<div class="container content-container">
    <div class="page-header">
        <h1>
            支付宝结果
            <small>subtext</small>
        </h1>
    </div>
    @include('components.page-frame.message-bar')
    {{ $verifyResult }}
    <p>
    </p>
</div>
@stop