@extends ('layouts.base')

@section ('content')
<div class="">	
	<div id="invoice">
		<img src="{{ asset(Config::get('optimall.lazyloadImg')) }}" 
		data-original="{{ asset('images/info/about-shoppings/invoice.jpg') }}" 
		class="lazy">
	</div>
	<div id="payment">
		<img src="{{ asset(Config::get('optimall.lazyloadImg')) }}" 
		data-original="{{ asset('images/info/about-shoppings/payment.jpg') }}" 
		class="lazy">
	</div>
	<div id="delivery">
		<img src="{{ asset(Config::get('optimall.lazyloadImg')) }}" 
		data-original="{{ asset('images/info/about-shoppings/delivery.jpg') }}" 
		class="lazy">
	</div>
	<div id="faq">
		<img src="{{ asset(Config::get('optimall.lazyloadImg')) }}" 
		data-original="{{ asset('images/info/about-shoppings/faq.jpg') }}" 
		class="lazy">
	</div>
</div>
@stop