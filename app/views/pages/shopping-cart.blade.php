@extends ('layouts.base')

@section('link-css')
@parent
{{ HTML::style('plugins/chosen_v1.0.0/chosen.min.css') }}
@stop

@section ('content')

<div class="container content-container">
    @include('components.product-page.progress-tracker', array('progtrckrStep' => 2))
    <div class="page-header">
        @include('components.page-frame.message-bar')

        @if(count($items))
        <div class="page-header-btn-group">
            <a href="{{ URL::to('gallery') }}" class="btn btn-default btn-sm">
                接着逛逛
            </a> 
            @if ($isAllPrescriptionComplete)
            <a href="{{ action('ShoppingCartController@getCheckout') }}" class="btn btn-warning btn-sm">
                去结算 
                <i class="fa fa-arrow-circle-right fa-lg"></i>
            </a>
            @else
            <a href="javascript:alertPrescriptionIncomplete();" class="btn btn-warning btn-sm">
                去结算 
                <i class="fa fa-arrow-circle-right fa-lg"></i>
            </a>
            @endif
        </div>      
        @endif
        <h1>我的购物车 <small>Subtext for header</small></h1>                     
    </div>

    @if(count($items))
    <div class="panel panel-default">
        <table class="table shopping-cart-table">
            <thead>
                <tr class="active">
                    <th>商品信息</th>
                    <th>验光单</th>
                    <th>订购数量</th>
                    <th>小计</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                @include('components.order-page.cart-item', array('$item' => $item, 'prescriptionNames'=>$prescriptionNames))
                @endforeach
                <tr class="active">                                
                    <td>                                       
                    </td> 
                    <td colspan="4">
                        {{ Form::open(array('action' => 'CouponController@postApplyCoupon', 'role' => 'form', 'class'=>'form-horizontal'))}}
                        <div class="form-group has-feedback" id="coupon-form-group">             
                            <label for="coupon_code" class="col-md-2 col-md-offset-4 control-label font-blue">
                                <strong>优惠券</strong>
                            </label>     
                            <div class="col-md-4">                                                
                                <input type="text" class="form-control" name="coupon_code" placeholder="优惠券代码" value="{{ $coupon->coupon_code or '' }}">
                                @if (isset($coupon))
                                <span class="form-control-feedback">
                                    <a href='#confirm-remove-coupon' data-toggle="modal">
                                        <i class='fa fa-times fa-lg'></i>
                                    </a>
                                </span>
                                @endif
                            </div>      
                            <div class="col-md-1">
                                <input type="submit" class="btn btn-primary btn-sm" value="使用优惠券">
                            </div>
                        </div>
                        {{ Form::close() }} 
                        {{ Form::open(array('action' => 'CouponController@postRemoveCoupon', 'id'=>'remove_coupon')) }}        
                        <div class="modal fade" id="confirm-remove-coupon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel">取消消费卷</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            <i class="fa fa-exclamation-triangle fa-lg"></i>
                                            确认要放弃使用消费卷？ 
                                        </p>
                                        <input type="submit" class="btn btn-danger btn-sm" value="确认">
                                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">取消</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        {{ Form::close() }}
                    </td>    
                </tr>
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-md-3 col-md-offset-9">
            <div class="panel panel-default">                        
                <!-- Table -->
                <table class="table table-condensed" id="shopping-cart-summary">
                    <thead></thead>
                    <tbody>
                        <tr>
                            <td class="">总价:</td>
                            <td class="" id="total_price_cell">
                                ¥{{ number_format($totalPrice, 2) }}                                
                            </td>
                        </tr>
                        <tr>
                            <td class="">折扣:</td>
                            <td class="">
                                -(<span id="discount_amt_cell">¥{{ number_format($totalDiscount, 2) }} </span>)
                            </td>
                        </tr>
                        <tr>
                            <td class="font-lg font-orange">
                                <strong>合计:</strong>
                            </td>
                            <td class="font-lg font-orange">
                                <strong id="net_amt_cell">¥{{ number_format($netPrice, 2) }}</strong>
                            </td>
                        </tr>
                    </tbody>                          
                </table>
            </div>                    
            <div class="page-header-btn-group">
                <a href="{{ URL::to('gallery') }}" class="btn btn-default btn-sm">接着逛逛</a> 
                @if ($isAllPrescriptionComplete)
                <a href="{{ action('ShoppingCartController@getCheckout') }}" class="btn btn-warning btn-sm">
                    去结算 
                    <i class="fa fa-arrow-circle-right fa-lg"></i>
                </a>
                @else
                <a href="javascript:alertPrescriptionIncomplete();" class="btn btn-warning btn-sm">
                    去结算 
                    <i class="fa fa-arrow-circle-right fa-lg"></i>
                </a>
                @endif
            </div>            
        </div>
    </div>
    @else 
    @include('components.order-page.cart-empty')
    @endif

</div>

@stop

@section("link-script")
@parent
{{ HTML::script('plugins/jQuery-Validation/jquery.validate.min.js') }}
{{ HTML::script('plugins/jQuery-Validation/additional-methods.min.js') }}
{{ HTML::script('plugins/chosen_v1.0.0/chosen.jquery.min.js') }}
@stop

@section("script")
@parent   
<script type="text/javascript">

@foreach($items as $item)
$("#prescription_modal_{{ $item->order_line_item_id }}").on("shown.bs.modal", function(e) {
    $("#prescription_modal_{{ $item->order_line_item_id }} .chosen-select")
    .chosen({width: "95%", no_results_text: "没有找到结果："});
});
@endforeach

function showUpdateBtn(id) {
    $("#update-" + id).removeClass("hide");
}

function alertPrescriptionIncomplete() {
    alert("对不起，您还没有填写验光单");
}

function togglePresName(itemId) {
    if ($('#prescription_modal_' + itemId + ' #remember_prescription').is(':checked')) {
        $('#prescription_modal_' + itemId + ' #prescription_user_field').removeClass('hidden').addClass('no-display').slideDown('fast');
    }
    else {
        $('#prescription_modal_' + itemId + ' #prescription_user_field').slideUp('fast', function() {
            $('#prescription_modal_' + itemId + ' #prescription_user_field').addClass('hidden').removeClass('no-display');
        });
    }
}

var currency = "¥";
function updateQuantity(itemId, action) {
    $.ajax({
        type: "POST",
        url: "{{ action('ShoppingCartController@postUpdateQuatity') }}",
        data: {order_line_item_id: itemId, action: action },
        datatype: 'json',
        beforeSend: function(request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='token']").attr('content'));
        }
    })
    .done(function(data) {            
            //var ajaxReturn = JSON.parse(data);      //parse the return data
            $("#quantity_" + itemId).text(data.quantity);
            $("#item_total_" + itemId).text(currency + data.itemTotal.toFixed(2));
            $("#total_price_cell").text(currency + data.totalPrice.toFixed(2));
            $("#discount_amt_cell").text(currency + data.discountAmount.toFixed(2));
            $("#net_amt_cell").text(currency + data.netAmount.toFixed(2));
            
        })
    .fail(function() {
            //if the connection to database failed
            alert("connection to database has failed");
        })
    .always(function() {
            //
        });
}

var warningIcon = "<i class='fa fa-warning fa-lg'></i> ";
var rule = {
    rules: {
        O_S_SPH: "required",
        O_D_SPH: "required",
        PD: "required",
        prescription_name: "required"
    },
    messages: {
        O_S_SPH: {
            required: warningIcon + "请填写度数"
        },
        O_D_SPH: {
            required: warningIcon + "请填写度数"
        },
        PD: {
            required: warningIcon + "请填写瞳距"
        },
        prescription_name: {
            required: warningIcon + "请给这只验光单起个名字"
        }
    },
    errorElement: "span",
    errorPlacement: function(error, element) {
        error.appendTo($(element).parent().parent());
    },
    success: function(label) {
        label.html("<span class='jq-validate-valid'><i class='fa fa-check-circle fa-lg'></i></span>");
    },
    validClass: "",
    errorClass: "jq-validate-error",
        //ignore: [], //uncomment to validate hidden input
        onkeyup: function(element) {
            $(element).valid();
        },
        onfocusout: function(element) {
            $(element).valid();
        },
        onclick: true
    };

    $(document).ready(function() {    
        @foreach($items as $item)
        $('#prescription_form_{{ $item->order_line_item_id }}').validate(rule);
        @endforeach
    });


    //enable popover
    $(document).ready(function() {
        $('.SPH_popover a').popover({
            trigger: 'hover',
            placement: 'bottom',
            html: true
        });
        $('.CYL_popover a').popover({
            trigger: 'hover',
            placement: 'bottom',
            html: true
        });
        $('.AXIS_popover a').popover({
            trigger: 'hover',
            placement: 'bottom',
            html: true
        });
        $('.ADD_popover a').popover({
            trigger: 'hover',
            placement: 'bottom',
            html: true
        });
        $('.PD_popover a').popover({
            trigger: 'hover',
            placement: 'right',
            html: true
        });
    });

    //enable popover of stored prescription
    @foreach($storedPrescriptions as $storedPrescription)
    $("#stored_pres_popover_{{ $storedPrescription->prescription_id }}").popover({
       html : true,
       title: "预览验光单详情",
       content: function() {return $("#stored_pres_form_{{ $storedPrescription->prescription_id }}").html();},
       trigger:"hover",
       container:"body",          
       placement:"right"          
   });
    @endforeach


    </script> 
    @stop
