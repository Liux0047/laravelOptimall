@extends ('layouts.base')

@section('link-css')
@parent
{{ HTML::style('plugins/chosen_v1.0.0/chosen.min.css') }}
@stop

@section ('content')
<div class="container content-container">
	@include('components.product-page.progress-tracker', array('progtrckrStep' => 3))
	<div class="page-header">
		@include('components.page-frame.message-bar')
		<h2>选择收货地址 <small>Subtext for header</small></h2>
	</div>      
	<div class="row no-display" id="address_section">
		@foreach ($addresses as $address)
		<div class="col-md-4">
			@include('components.order-page.address-box', array('modalAction'=>'edit', 'address'=>$address, 'selectedAddress'=>$selectedAddress))
		</div>
		@endforeach

		<div class="col-md-4"><a href="#add_address_modal" data-toggle="modal">
			<i class="fa fa-plus"></i> 添加新地址</a>
		</div>        
		{{ Form::open(array('action' => 'AddressController@postAddAddress', 'id'=>'add_address_form', 'class'=>'form-horizontal', 'novalidate'=>'novalidate')) }}
		@include('components.order-page.address-modal', array('fieldPrefix'=>'add', 'modalId'=>'add_address_modal', 'address'=>$newAddress ))
		{{ Form::close() }}		
	</div>     


	<div class="checkbox">
		<label>
			<input type="checkbox" id="toggle_address">
			使用支付宝地址                    
		</label>
	</div>

	<div class="page-header">
		<h2>确认订单详情 <small>Subtext for header</small></h2>
	</div>                
	<div class="panel panel-default">
		<table class="table shopping-cart-table">
			<thead>
				<tr class="success">
					<th>商品信息</th>
					<th>验光单</th>
					<th>订购数量</th>
					<th>小计</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($items as $item)
				@include('components.order-page.checkout-item-info', array('item' =>$item, 'prescriptionNames'=>$prescriptionNames))
				@endforeach                     
			</tbody>                    
		</table>
	</div>

	<div class="row">
		{{ Form::open(array('action'=>'OrderController@postSubmitOrder', 'onsubmit'=>'alertIfNoAddress();', 'id'=>'order_submit_form', 'role'=>'form')) }}   
		<div class="col-md-6">
			<div class="form-group">
				<textarea class="form-control" name="message_to_seller" rows="2" placeholder="买家留言(45字以内)"></textarea>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox" id="is_invoice_required">需要发票
				</label>
			</div>
			<div class="form-group">
				<input type="text" class="form-control no-display" id="invoice_header" name="invoice_header" placeholder="请填写发票抬头">
			</div>
		</div>
		<div class="col-md-4 col-md-offset-2">
			<div class="panel panel-default align-right">                            
				<div class="panel-body">
					<p>
						<strong>实付款:</strong>
						<span class="font-lg font-orange"><strong>¥{{ number_format($netPrice, 2) }}</strong></span>
						<br>
						<span class="font-grey"> (含 ¥{{ number_format($totalDiscount, 2) }} 折扣 ) </span>
					</p>
					@if (isset($selectedAddress))
					<p id="address_summary">
						<strong>寄送至:</strong>						
						{{ $selectedAddress->province }}   
						{{ $selectedAddress->city }}
						{{ $selectedAddress->area }}
						{{ $selectedAddress->street_name }}, 
						{{ $selectedAddress->postal_code }}
						<br>
						<strong>收货人:</strong>
						{{ $selectedAddress->recipient_name }} {{ $selectedAddress->phone }}                              
					</p>
					@else
					您还没有填写地址
					@endif
				</div>
				<div class="panel-footer">					
					<input type="hidden" name="use_alipay_address" id="use_alipay_address" value="0">
					@if (isset($selectedAddress))
					<input type="hidden" name="recipient_name" value="{{ $selectedAddress->recipient_name }}">
					<input type="hidden" name="receive_address" value="{{ $selectedAddress->province }}  {{ $selectedAddress->city }} {{ $selectedAddress->area }} {{ $selectedAddress->street_name }}">
					<input type="hidden" name="receive_zip" value="{{ $selectedAddress->postal_code }}">
					<input type="hidden" name="receive_phone" value="{{ $selectedAddress->phone }}">
					<input type="hidden" name="item_names" value="@foreach ($items as $item){{ $item->model_name_cn }} @endforeach">  
					@else
					@endif                        
					<a href="{{ action('ShoppingCartController@getMyCart') }}" class="space-right">
						<i class="fa fa-arrow-circle-left"></i>  
						返回购物车            
					</a>
					<input type="submit" class="btn btn-warning btn-sm" value="提交订单">          
				</div>
			</div><!-- .panel -->                            
		</div>
		{{ Form::close() }}
	</div><!-- .row -->                
</div>
@stop

@section("link-script")
@parent
{{ HTML::script('plugins/jQuery-Validation/jquery.validate.min.js') }}
{{ HTML::script('plugins/jQuery-Validation/additional-methods.min.js') }}
{{ HTML::script('plugins/jsAddress/jsAddress.js') }}
@stop

@section("script")
@parent   
<script type="text/javascript">
	/*
	 * hide or show address area in respond to choose_alipay_address selection
	 */
	 $(document).ready(function() {
	 	$("#address_section").show(300);   

	 	$("#toggle_address").change(function() {
	 		if (this.checked) {
	 			$("#address_section").hide(300);
	 			$("#address_summary").hide(300);
	 			$("input[name='use_alipay_address']").val('1');
	 		}
	 		else {
	 			$("#address_section").show(300);
	 			$("#address_summary").show(300);
	 			$("input[name='use_alipay_address']").val('0');
	 		}
	 	});      

	 	$("#is_invoice_required").change(function() {
	 		if (this.checked) {
	 			$("#invoice_header").show(300);	 			
	 		}
	 		else {
	 			$("#invoice_header").hide(300);
	 		}
	 	});                

	    //address input validation rule
	    var warningIcon = "<i class='fa fa-warning fa-lg'></i> ";
	    var rule = {
	    	rules: {
	    		province: {
	    			required: true,
	    			maxlength:25
	    		},
	    		postal_code: {
	    			required: true,
	    			digits:true,
	    			minlength:5,
	    			maxlength:6
	    		},
	    		street_name: {
	    			required: true,
	    			minlength:5,
	    			maxlength:100
	    		},
	    		recipient_name:{
	    			required: true,
	    			maxlength: 45
	    		},
	    		phone: {
	    			required: true,	    			
	    			digits: true,
	    			minlength:8,
	    			maxlength:20
	    		}
	    	},                    
	    	messages: {
	    		province: {
	    			required: warningIcon + "请选择省份"
	    		},
	    		postal_code: {
	    			required: warningIcon + "请输入邮编",
	    			digits:warningIcon + "请输入正确格式的邮编",
	    			minlength:warningIcon + "请输入正确格式的邮编",
	    			maxlength:warningIcon + "请输入正确格式的邮编"
	    		},
	    		street_name: {
	    			required: warningIcon + "请输入邮编",
	    			minlength:warningIcon + "请输入至少五个字符",
	    			maxlength:warningIcon + "字符数超过上限(100)"
	    		},
	    		recipient_name:{
	    			required: warningIcon + "请输入收件人姓名",
	    			maxlength:warningIcon + "字符数超过上限(45)"
	    		},
	    		phone: {
	    			required: warningIcon + "请输入收件人电话",	    			
	    			digits: warningIcon + "请输入正确的电话号码",
	    			minlength: warningIcon + "请输入正确的电话号码",
	    			maxlength:warningIcon + "字符数超过上限(20)"                    
	    		}
	    	},
	    	errorElement: "span",
	    	errorPlacement: function(error, element) {
	    		error.appendTo($(element).parent());
	    	},
	    	validClass: "",
	    	errorClass: "jq-validate-error",
	        //ignore: [], //validate hidden input
	        onclick: true
	        
	    };
	    
	    $("#edit_address_form").validate(rule);                
	    $("#add_address_form").validate(rule);

	    //validate order submit for
	    $("#order_submit_form").validate({
	    	rules: {
	    		message_to_seller: {
	    			maxlength: 45
	    		},
	    		invoice_header: {
	    			maxlength: 45
	    		}
	    	},                    
	    	messages: {
	    		message_to_seller: {
	    			maxlength: warningIcon+ "请控制在45字以内"
	    		},
	    		invoice_header: {
	    			maxlength: warningIcon + "请控制在45字以内"
	    		}
	    	},
	    	errorElement: "span",
	    	errorPlacement: function(error, element) {
	    		error.appendTo($(element).parent());
	    	},
	    	validClass: "",
	    	errorClass: "jq-validate-error",
	        //ignore: [], //validate hidden input
	        onclick: true
	    });
	});

function alertIfNoAddress(){
	if ($("#toggle_address").checked){
		return true;
	}
	else {
		@if(isset($selectedAddress))
		return true;
		@else
		return confirm("确认不填入地址？（您可以在支付宝中选择您的送货地址）？");
		@endif
	}
}

</script> 

<script type="text/javascript">
@if(isset($selectedAddress))
addressInit('edit_province','edit_city','edit_area','{{ $selectedAddress->province }}','{{ $selectedAddress->city }}','{{ $selectedAddress->area }}');
@endif
addressInit('add_province','add_city','add_area');
</script>   
@stop