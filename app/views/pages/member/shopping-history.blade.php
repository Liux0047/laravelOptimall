@extends ('layouts.base')

@section('link-css')
@parent
{{ HTML::style('plugins/raty-2.7.0/jquery.raty.css') }}
@stop

@section ('content')
<div class="container content-container">
    <div class="page-header">
        <h1>我的目光之城                    
            <small>已购买的商品</small>
        </h1>
    </div>
    <div class="row">
        @include('components.member-account.side-nav', array('entry'=>1))
        <div class="col-xs-12 col-sm-10">

            @include('components.page-frame.message-bar')
            @if (count($orders))
            @foreach ($orders as $order)
            @include('components.member-account.item-info', array('order'=>$order, 'items'=>$order->orderLineItemViews,'prescriptionNames'=>$prescriptionNames))
            @endforeach    
            @else
            您还没有购买任何商品
            @endif
        </div><!--col-md-10-->
    </div><!--/row-->
</div>
@stop



@section('link-script')
@parent
{{ HTML::script('plugins/jQuery-Validation/jquery.validate.min.js') }}
{{ HTML::script('js/jQuery-Validation-customize.js') }}
{{ HTML::script('plugins/raty-2.7.0/jquery.raty.js') }}
@stop


@section('script')
@parent
<script type="text/javascript">
$(document).ready(function() {
    // validate refund form on keyup and submit
    var warningIcon = "<i class='fa fa-warning fa-lg'></i> ";
    $(".refund-form").each(function() {
        $(this).validate({
            rules: {
                reason: {
                    required: true,
                    maxlength: 150
                }
            },
            messages: {
                reason: {
                    required: warningIcon + "请填写退款理由",
                    maxlength: warningIcon + "请不要超过150字"
                }
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                error.appendTo($(element).parent());
            },
            validClass: "",
            errorClass: "jq-validate-error",
            //ignore: [], //validate hidden input
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
});


// shipping info query
$(".shipping-info-modal").each(function () {
    $(this).on('show.bs.modal', function (e) {
        if(!$(this).prop('data-shipping-info-retrieved')){
            var trackingNumber = $(this).attr("data-shipping-track-num");
            var company = $(this).attr("data-shipping-company");
            var insertHolder = $(this).find(".modal-body");
            var element = $(this);
            $.ajax({
                type: "POST",
                url: "{{ action('MemberAccountController@postShippingInfo') }}",
                data: {
                    tracking_number: trackingNumber,
                    company: company
                },
                beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='token']").attr('content'));
                },
                dataType: "html"
            })
            .done(function(data) {
                insertHolder.html(data);
            })
            .fail(function() {
                alert("获取物流信息失败");
            })
            .always(function() {
                element.prop('data-shipping-info-retrieved', true);
            });
        }
    });
});
</script>

@stop