@extends ('layouts.customer-base')

@section('link-css')
{{ HTML::style('plugins/chosen_v1.0.0/chosen.min.css') }}
@parent
@stop

@section ('content')

<div class="container content-container">
    @include('components.product-page.progress-tracker', array('progtrckrStep' => 2))
    <div class="page-header">
        <div class="page-header-btn-group">
            <a href="/optimall/product-gallery.php" class="btn btn-default btn-sm">
                接着逛逛
            </a> 
            <a href="javascript:alertPrescriptionIncomplete();" class="btn btn-warning btn-sm">
                去结算 
                <i class="fa fa-arrow-circle-right fa-lg"></i>
            </a>
        </div>                      
        <h1>我的购物车 <small>Subtext for header</small></h1>                     
    </div>

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
                @include('components.order-page.cart-item', 
                array('O_S_LEFTNames' => $O_S_LEFTNames, 
                'O_D_RIGHTNames' => $O_D_RIGHTNames,
                'CommonNames' => $CommonNames )
                )
                <tr class="active">                                
                    <td>                                       
                    </td> 
                    <td colspan="4">
                        <form class="form-horizontal" action="/optimall/functions/process-POST/POST-to-shopping-cart.php" method="post" role="form">
                            <input type="hidden" name="cart_action" value="7">
                            <div class="form-group" id="coupon-form-group">             
                                <label for="coupon_code" class="col-md-2 col-md-offset-4 control-label font-blue">
                                    <strong>优惠券</strong>
                                </label>     
                                <div class="col-md-4">                                                
                                    <input type="text" class="form-control" name="coupon_code" placeholder="优惠券代码" value="">                                                       
                                </div>           
                                <div class="col-md-1">
                                    <input type="submit" class="btn btn-primary btn-sm" value="使用优惠券">
                                </div>
                            </div>
                        </form>  
                    </td>    
                </tr>
            </tbody>
        </table>
    </div>

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
    
    $("#prescription_modal_11").on("shown.bs.modal", function (e) { $("#prescription_modal_11 .chosen-select").chosen({width:"95%",no_results_text: "没有找到结果："}); });                
            
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
            url: "update-quantity.php",
            data: {item_id: itemId,
                cart_action: action
            }
        }).done(function(data) {
            var ajaxReturn = JSON.parse(data);      //parse the return data
            $("#quantity_" + itemId).text(ajaxReturn.quantity);
            $("#item_total_" + itemId).text(currency + ajaxReturn.itemTotal.toFixed(2));
            $("#total_price_cell").text(currency + ajaxReturn.totalPrice.toFixed(2));
            $("#discount_amt_cell").text(currency + ajaxReturn.discountAmount.toFixed(2));
            $("#net_amt_cell").text(currency + ajaxReturn.netAmount.toFixed(2));
        }).fail(function() {
            //if the connection to database failed
            alert("connection to database has failed");
        }).always(function() {
            //
        });
    }

    var warningIcon = "<i class='fa fa-warning fa-lg'></i> ";
    var rule = {
        rules: {
            O_S_SPH: "required",
            O_D_SPH: "required",
            PD: "required",
            prescription_user_name: "required"
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
            prescription_user_name: {
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
        $('#prescription_form_').validate(rule);
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


</script> 
@stop
