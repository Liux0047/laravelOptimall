@extends ('layouts.base')

@section('link-css')
@parent
{{ HTML::style('plugins/chosen_v1.0.0/chosen.min.css') }}
@stop

@section ('content')
<div class="container content-container">
	@include('components.product-page.progress-tracker', array('progtrckrStep' => 3))
	<div class="page-header">
		<h2>选择收货地址 <small>Subtext for header</small></h2>
	</div>      
	<div class="row" id="address_section">
		@foreach ($addresses as $address)
		<div class="col-md-4">
			@include('components.order-page.address-box', array('modalAction'=>'edit', 'address'=>$address))
		</div>
		@endforeach

		<div class="col-md-4"><a href="#add_address_modal" data-toggle="modal">
			<i class="fa fa-plus"></i> 添加新地址</a>
		</div>        
		{{ Form::open(array('url' => 'checkout/add-address', 'id'=>'edit_address_form', 'class'=>'form-horizontal', 'novalidate'=>'novalidate')) }}
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
				@include('components.order-page.checkout-item-info', array('item' =>$item,'O_S_LEFTNames' => $O_S_LEFTNames,'O_D_RIGHTNames' => $O_D_RIGHTNames,'CommonNames' => $CommonNames))
				@endforeach                     
			</tbody>                    
		</table>
	</div>

	<div class="row">
		<div class="col-md-4 col-md-offset-8">
			<div class="panel panel-default align-right">                            
				<div class="panel-body">
					<p>
						<strong>实付款:</strong>
						<span class="font-lg font-orange"><strong>¥596.00</strong></span>
					</p>
					@if (isset($selectedAddress))
					<p id="address_summary">
						<strong>寄送至:</strong>						
						{{ $address->province }}   
						{{ $address->city }}
						{{ $address->area }}
						{{ $address->street_name }}, 
						{{ $address->postal_code }}
						<br>
						<strong>收货人:</strong>
						{{ $address->recipient_name }} {{ $address->phone }}                              
					</p>
					@else
					您还没有填写地址
					@endif
				</div>
				<div class="panel-footer">
					<form role="form" action="/optimall/alipay/alipayapi.php?alipay_action=1" method="post" id="alipay_form" onsubmit="return true;">   
						<input type="hidden" name="use_alipay_address" id="use_alipay_address" value="0">
						@if (isset($selectedAddress))
						<input type="hidden" name="receive_name" value="{{ $address->recipient_name }}">
						<input type="hidden" name="receive_address" value="{{ $address->province }}  {{ $address->city }} {{ $address->area }} {{ $address->street_name }}">
						<input type="hidden" name="receive_zip" value="{{ $address->postal_code }}">
						<input type="hidden" name="receive_phone" value="{{ $address->phone }}">
						<input type="hidden" name="item_names" value="
						@foreach ($items as $item)
						{{ $item->model_name_cn }} 
						@endforeach
						">  
						@else
						@endif                        
						<a href="{{ URL::to('shopping-cart') }}" class="space-right">
							<i class="fa fa-arrow-circle-left"></i>  
							返回购物车            
						</a>
						<input type="submit" class="btn btn-warning btn-sm" value="提交订单">          
					</form>      

				</div>
			</div><!-- .panel -->                            
		</div>
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
	 	$("#toggle_address").change(function() {
	 		if (this.checked) {
	 			$("#address_section").slideUp();
	 			$("#address_summary").slideUp();
	 			$("input[name='use_alipay_address']").val('1');
	 		}
	 		else {
	 			$("#address_section").slideDown();
	 			$("#address_summary").slideDown();
	 			$("input[name='use_alipay_address']").val('0');
	 		}
	 	});                

	    //address input validation rule
	    var warningIcon = "<i class='fa fa-warning fa-lg'></i> ";
	    var rule = {
	    	rules: {
	    		province: {
	    			required: true
	    		},
	    		postal_code: {
	    			required: true,
	    			digits:true,
	    			minlength:6,
	    			maxlength:6
	    		},
	    		street_name: {
	    			required: true,
	    			minlength:5
	    		},
	    		recipient_name:{
	    			required: true
	    		},
	    		phone: {
	    			required: true,
	    			minlength:8,
	    			digits: true
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
	    			minlength:warningIcon + "请输入至少五个字符"
	    		},
	    		recipient_name:{
	    			required: warningIcon + "请输入收件人姓名"
	    		},
	    		phone: {
	    			required: warningIcon + "请输入收件人电话",
	    			minlength: warningIcon + "请输入正确的电话号码",
	    			digits: warningIcon + "请输入正确的电话号码"                    
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
	});

function alertNoAddress(){
	if ($("#toggle_address").checked){
		return true;
	}
	else {
		return confirm("确认不填入地址？（您可以在支付宝中选择您的送货地址）？");
	}
}

</script> 

<script type="text/javascript">
@if (isset($selectedAddress))
addressInit('edit_province','edit_city','edit_area','{{ $selectedAddress->province }}','{{ $selectedAddress->city }}','{{ $selectedAddress->aree }}');
@endif

addressInit('add_province','add_city','add_area')
</script>   
@stop