@extends ('layouts.base')

@section('link-css')
@parent
{{ HTML::style('css/help-page.css'); }}
@stop

@section ('content')
<div id="muguangzhicheng" class="about-product-section">
	<div class="section-title">
		<img src="{{ asset('images/lazyload-holder.png') }}" 
		data-original="{{ asset('images/help/about-product/InfoPage-title-1.jpg') }}" 
		class="lazy">
	</div>
	<div class="section-element-container">
		<img src="{{ asset('images/lazyload-holder.png') }}" 
		data-original="{{ asset('images/help/about-product/InfoPage-1.jpg') }}" 
		class="lazy">
	</div>		
	<div class="section-transition">
		<img src="{{ asset('images/lazyload-holder.png') }}" 
		data-original="{{ asset('images/help/about-product/InfoPage-1bg.jpg') }}" 
		class="lazy">
	</div>
</div>

<div id="shihuiduoduo" class="about-product-section">
	<div class="section-title">
		<img src="{{ asset('images/lazyload-holder.png') }}" 
		data-original="{{ asset('images/help/about-product/InfoPage-title-2.jpg') }}" 
		class="lazy">
	</div>
	<div class="section-element-container">
		<img src="{{ asset('images/lazyload-holder.png') }}" 
		data-original="{{ asset('images/help/about-product/InfoPage-2.jpg') }}" 
		class="lazy">
	</div>		
	<div class="section-transition">
		<img src="{{ asset('images/lazyload-holder.png') }}" 
		data-original="{{ asset('images/help/about-product/InfoPage-2bg.jpg') }}" 
		class="lazy">
	</div>
</div>

<div id="gaopingzhizuo" class="about-product-section">
	<div class="section-title">
		<img src="{{ asset('images/lazyload-holder.png') }}" 
		data-original="{{ asset('images/help/about-product/InfoPage-title-3.jpg') }}" 
		class="lazy">
	</div>
	<div class="section-element-container">
		<img src="{{ asset('images/lazyload-holder.png') }}" 
		data-original="{{ asset('images/help/about-product/InfoPage-3.jpg') }}" 
		class="lazy">
	</div>		
	<div class="section-transition">
		<img src="{{ asset('images/lazyload-holder.png') }}" 
		data-original="{{ asset('images/help/about-product/InfoPage-3bg.jpg') }}" 
		class="lazy">
	</div>
</div>

<div id="gouwubaozhang-1" class="about-product-section">
	<div class="section-title">
		<img src="{{ asset('images/lazyload-holder.png') }}" 
		data-original="{{ asset('images/help/about-product/InfoPage-title-4.jpg') }}" 
		class="lazy">
	</div>
	<div class="section-element-container">
		<img src="{{ asset('images/lazyload-holder.png') }}" 
		data-original="{{ asset('images/help/about-product/InfoPage-4-1.jpg') }}" 
		class="lazy">
	</div>		
	<div class="section-transition">
		<img src="{{ asset('images/lazyload-holder.png') }}" 
		data-original="{{ asset('images/help/about-product/InfoPage-4bg.jpg') }}" 
		class="lazy">
	</div>
</div>

<div id="gouwubaozhang-2" class="about-product-section">
	<div class="section-element-container">
		<img src="{{ asset('images/lazyload-holder.png') }}" 
		data-original="{{ asset('images/help/about-product/InfoPage-4-2.jpg') }}" 
		class="lazy"> 
	</div>
</div>
@stop

@section('script')
@parent
<script>
</script>
@stop