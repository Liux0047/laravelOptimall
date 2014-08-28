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
					<p id="address_summary">
						<strong>寄送至:</strong>
						新加坡  22 Nanyang Avenue                                    
						<br>
						<strong>收货人:</strong>
						Xiao Liu 6598515106                                
					</p>
				</div>
				<div class="panel-footer">
					<form role="form" action="/optimall/alipay/alipayapi.php?alipay_action=1" method="post" id="alipay_form" onsubmit="return true;">   
						<input type="hidden" name="use_alipay_address" id="use_alipay_address" value="0">
						<input type="hidden" name="receive_name" value="Xiao Liu">
						<input type="hidden" name="receive_address" value="新加坡  22 Nanyang Avenue">
						<input type="hidden" name="receive_zip" value="639810">
						<input type="hidden" name="receive_phone" value="6598515106">
						<input type="hidden" name="item_names" value="沁心 炫彩夏威夷 ">                          
						<a href="/optimall/shopping-cart.php" class="space-right">
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
{{ HTML::script('plugins/chosen_v1.0.0/chosen.jquery.min.js') }}
@stop

@section("script")
@parent   
@stop