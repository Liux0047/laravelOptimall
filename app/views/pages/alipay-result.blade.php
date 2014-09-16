@extends ('layouts.base')

@section ('content')
<div class="container content-container">
    @if($isPaymentSuccessful)
    <div class="page-header">
        @include('components.page-frame.message-bar')
        <h1>
            <i class="fa fa-check-circle font-green"></i> 
            支付成功
            <small>共计金额 ¥{{ number_format($totalAmount, 2) }} 元</small>
        </h1>
    </div>    
    <div class="panel panel-success">
        <div class="panel-heading">
            <h5 class="panel-title">                
                以下订单已经支付成功 - 共计 ¥{{ number_format($totalAmount, 2) }} 元
            </h5>
        </div>
        <div class="panel-body">
            <div class="pull-right">
                <a href="{{ action('MemberAccountController@getShoppingHistory') }}"> 查看订单详情 </a>
            </div>            
            <p>
                订单号： {{ $orderId }}
            </p>
            <p>
                在线支付: ¥{{ number_format($totalAmount, 2) }} 元
            </p>
            <p>
                由目光之城发货
            </p>
            <p>
                <a href="{{ URL::to('/') }}" class="btn btn-danger"> 接着逛逛 </a>                
            </p>
        </div>
    </div>
    @else
    <h1>
        支付失败
        {{ var_dump($_GET) }}
    </h1>
    @endif
</div>
@stop