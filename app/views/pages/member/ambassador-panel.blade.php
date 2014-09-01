@extends ('layouts.base')

@section ('content')
<div class="container content-container">
    <div class="page-header">
        <h1>我的目光之城                    
            <small>目光之星</small>
        </h1>
    </div>
    <div class="row">
        @include('components.member-account.side-nav', array('entry'=>4))

        <div class="col-xs-12 col-md-10">         
            @include('components.page-frame.message-bar')
            
            <div class="panel panel-primary">
                <div class="panel-heading">
                    您好友的购买详情
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <td>好友昵称</td>
                            <td>邮箱</td>
                            <td>购物时间</td>
                            <td>付款总额</td>
                            <td>优惠类型</td>
                            <td>返利比例</td>
                            <td>返利金额</td>
                            <td>状态</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ambassadorOrders as $order)
                        <tr @if($order->is_ambassador_reward_claimed) class="obscure" @endif>
                            <td>{{ $order->nickname }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>¥{{ number_format($order->total_transaction_amount, 2) }}</td>
                            <td>
                                @if($order->is_first_purchase)
                                首次购买
                                @else
                                60天内后续购买
                                @endif
                            </td>
                            <td>
                                @if($order->is_first_purchase)
                                {{ Config::get('optimall.ambassadorFirstReward')*100 }}%
                                @else
                                {{ Config::get('optimall.ambassadorSubsequentReward')*100 }}%
                                @endif
                            </td>
                            <td>¥{{ number_format($reward[$order->order_id], 2) }}</td>
                            <td>
                                @if($order->is_ambassador_reward_claimed)                                 
                                @if ($order->is_ambassador_reward_processed)
                                已领取
                                @else
                                已申请领取
                                @endif
                                @else
                                可领取
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="panel-footer">
                    <div class="align-right">
                        总计可返利: ¥{{ number_format($totalReward, 2) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop


@section('link-script')
@parent
@stop

@section('script')
@parent
<script type="text/javascript">
</script> 
@stop