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

            <div>
                <h5>
                    我的邀请码: <strong>{{ Auth::user()->ambassador_code }}</strong>
                </h5>                
            </div>
            <br>
            
            <div class="panel panel-primary">
                <div class="panel-heading">
                    好友的购买详情
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
                        总计可返利: 
                        <span class="font-orange"><strong>¥{{ number_format($totalReward, 2) }}</strong></span>
                    </div>
                </div>
            </div>
            <div class="align-right">
                {{ Form::open(array('action'=>'AmbassadorController@postClaimRewards'))}}
                {{ Form::submit('申请领取', array('class'=>'btn btn-primary btn-sm'))}}
                {{ Form::close() }}
            </div>

            <div>
                <p>
                    @if (isset(Auth::user()->alipay_account))
                    <h5>
                        我的支付宝账号:  
                        <span class="font-orange"><strong>{{ Auth::user()->alipay_account }} </strong></span>
                        <small>
                            <a title="Click to dropdown" href="#" onclick="$('#change_alipay_block').toggle(300);return false;">                        
                                <i class="fa fa-pencil"></i>  更换 
                            </a>
                        </small>
                    </h5>
                    
                    <div class="no-display" id="change_alipay_block">
                        {{ Form::open(array('action'=>'AmbassadorController@postChangeAlipayAccount', 'role'=>'form', 'id'=>'change_alipay_form', 'class'=>'form-horizontal'))}}
                        <div class="form-group">
                            <label for="alipay_account" class="col-sm-2 control-label">支付宝账号</label>
                            <div class="col-md-6">
                                <input type="text" id="alipay_account" name="alipay_account" class="form-control" value="{{ Auth::user()->alipay_account }}" placeholder="请填写您的支付宝账号">
                            </div>              
                        </div>          
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                {{ Form::submit('确认更换', array('class'=>'btn btn-primary btn-sm'))}}
                            </div>
                        </div>  
                        {{ Form::close() }}
                    </div>
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
@stop


@section('link-script')
@parent
{{ HTML::script('plugins/jQuery-Validation/jquery.validate.min.js') }}
{{ HTML::script('js/jQuery-Validation-customize.js') }}
@stop


@section('script')
@parent
<script type="text/javascript">
$(document).ready(function() {
    // validate signup form on keyup and submit
    var warningIcon = "<i class='fa fa-warning fa-lg'></i> ";
    $("#change_alipay_form").validate({
        rules: {
            alipay_account: {
                required: true
            }
        },
        messages: {
            alipay_account: {
                required: warningIcon + "请输入您的支付宝账号"
            }
        },
        errorElement: "span",
        errorPlacement: function(error, element) {
            error.appendTo($(element).parent());
        },
        success: function(label) {
            label.html("<span class='jq-validate-valid'><i class='fa fa-check-circle fa-lg'></i></span>");
        },
        validClass: "",
        errorClass: "jq-validate-error",
        ignore: [], //validate hidden input
        onkeyup: function(element) {
            $(element).valid();
        },
        onfocusout: function(element) {
            $(element).valid();
        },
        //onkeyup: true,
        //onfocusout: true,
        onclick: true
    });
});

</script>
@stop