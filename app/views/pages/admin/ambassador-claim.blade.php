@extends ('layouts.admin-base')

@section ('content')
<div class="container content-container content-no-header">
    <div class="page-header">
        @include('components.page-frame.message-bar')
        <h1>
            {{ $pageTitle }}
        </h1>
    </div>
    {{ Form::open(array('action'=>'AdminFunctionController@postAmbassadorClaim'))}}
    <table class="table table-hover">
        <thead>
            <tr>
                <th></th>
                <th>申请人(目光之星)</th>                
                <th>支付账号</th>
                <th>购买人</th>
                <th>购买人注册时间</th>
                <th>下单时间</th>
                <th>订单总额</th>
                <th>是否首次购买</th>
                <th>订单可返利</th>
            </tr>
        </thead>
        @foreach($claims as $claim)
        <tr class="reward-row">
            <td>
                <input type="checkbox" name="orders[]" value="{{ $claim->order_id }}" onchange="calculateTotal()">
            </td>        
            <td>                
                {{ $claim->ambassador->nickname }}<br>
                {{ $claim->ambassador->email }}
            </td>    
            <td>
                {{ $claim->ambassador->ambassadorInfo->alipay_account }}
            </td>
            <td>
                {{ $claim->nickname }} <br>
                {{ $claim->email }}
            </td>
            <td>
                {{ $claim->ambassador_relation_created_at }}
            </td>
            <td>
                {{ $claim->order_created_at }}
            </td>
            <td >
                {{ $claim->total_transaction_amount }}
            </td>
            <td>
                @if ($claim->is_first_purchase)
                是
                @else
                否
                @endif                
            </td>
            <td class="amount">
                <span>{{ $rewards['reward'][$claim->order_id]}}</span>
            </td>
        </tr>

        @endforeach
    </table>
    <h5>总计： <span id="reward_total">0.00</span></h5>
    <div class="pull-right">
        {{ Form::submit('确认已经返利', array('onsubmit' =>'confirmChangeStatus', 'class'=>'btn btn-primary')) }}
    </div>
    {{ Form::close()}}

    {{  $claims->links() }}

</div>
@stop

@section('script')
@parent
<script type="text/javascript">
function confirmChangeStatus () {
    return confirm('确认改变状态?');
}

function calculateTotal() {
    var total = 0.0;
    $(".reward-row").each(function(){
        if ($(this).find("input[type=checkbox]").is(':checked')){
            total += parseFloat($(this).find('.amount span').text());
        }
    });
    $("#reward_total").html(total.toFixed(2));
}


</script> 
@stop