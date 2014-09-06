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
		{{ Form::hidden('address_id', $address->address_id )}}
		<a title="use this address" href="#" onclick="$(this).closest('form').submit();return false;">
			<i class="fa fa-location-arrow fa-lg"></i> 使用此地址
		</a>
		{{ Form::close() }}		
		@endif
	</div>
</div>