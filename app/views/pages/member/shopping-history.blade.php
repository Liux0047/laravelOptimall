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


    //validate review form
    $(".review-form").each(function() {
        $(this).validate({      
            rules: {
                title: {
                    required: true,
                    maxlength: 45
                },
                content: {
                    required: true,
                    maxlength: 200
                },
                score_comfort: "required",
                score_design: "required",
                score_quality: "required"
            },
            messages: {
                title: {
                    required: warningIcon + "请输入评论标题",
                    maxlength: warningIcon + "请不要超过字符上限(45)"
                },
                content: {
                    required: warningIcon + "请输入评论内容",
                    maxlength: warningIcon + "请不要超过字符上限(200)"
                },
                score_comfort: {
                    required: warningIcon + "请选择分数"
                },
                score_design: {
                    required: warningIcon + "请选择分数"
                },
                score_quality: {
                    required: warningIcon + "请选择分数"
                }                
            },
            errorElement: "p",
            errorPlacement: function(error, element) {
                error.appendTo($(element).parent());
            },
            validClass: "",
            errorClass: "jq-validate-error",
            //ignore: [], //uncomment to validate hidden input
            onclick: true   
        });
});

    //enable raty function 
    $(".raty-star-input").raty({ 
        path: "{{ asset('plugins/raty-2.7.0/images') }}", 
        halfShow : false,
        scoreName: function() {
            return $(this).attr('data-scoreName');
        }
    });

});
</script>
@stop