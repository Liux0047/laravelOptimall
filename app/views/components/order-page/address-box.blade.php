<div class="panel panel-default address-panel address-panel-selected"> 
	<i class="fa fa-check fa-lg"></i>
	<div class="panel-body">
		<h5><strong>{{ $address->recipient_name }}</strong> (收) </h5>
		<p>
			{{ $address->province }}   
			{{ $address->city }}
			{{ $address->area }}
			{{ $address->street_name }}
			<br> 邮编: {{ $address->postal_code }}
			<br>电话: {{ $address->phone }}
		</p>
		<a data-toggle="modal" href="#address_modal_{{ $address->address_id }}">
			<i class="fa fa-edit fa-lg"></i> 
			编辑地址
		</a>        
		{{ Form::open(array('url' => 'checkout/update-address', 'id'=>'edit_address_form', 'class'=>'form-horizontal', 'novalidate'=>'novalidate')) }}
		<input type="hidden" name="address_id" value="{{ $address->address_id }}">  
		@include('components.order-page.address-modal', array('fieldPrefix'=>$modalAction, 'modalId'=>'address_modal_'.$address->address_id,'address'=>$address))
		{{ Form::close() }}
	</div>
</div>