<div class="panel panel-default address-panel @if($address->address_id==$selectedAddress->address_id) address-panel-selected @endif"> 
	@if($address->address_id==$selectedAddress->address_id) 
	<i class="fa fa-check fa-lg"></i>
	@endif
	
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
		@if($address->address_id==$selectedAddress->address_id) 
		<a data-toggle="modal" href="#address_modal_{{ $address->address_id }}">
			<i class="fa fa-edit fa-lg"></i> 
			编辑地址
		</a>    
		@else
		{{ Form::open(array('action' => 'AddressController@postUseAddress')) }}
		<input type="hidden" name="address_id" value="{{ $address->address_id }}">		
		<a title="use this address" href="#" onclick="$(this).closest('form').submit();return false;">
			<i class="fa fa-location-arrow fa-lg"></i> 使用此地址
		</a>
		{{ Form::close() }}		
		@endif

		@if($address->address_id==$selectedAddress->address_id)	
		{{ Form::open(array('action' => 'AddressController@postUpdateAddress', 'id'=>'edit_address_form', 'class'=>'form-horizontal', 'novalidate'=>'novalidate')) }}
		<input type="hidden" name="address_id" value="{{ $address->address_id }}">  
		@include('components.order-page.address-modal', array('fieldPrefix'=>$modalAction, 'modalId'=>'address_modal_'.$address->address_id,'address'=>$address))
		{{ Form::close() }}
		@endif
	</div>
</div>
