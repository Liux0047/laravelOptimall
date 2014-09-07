<div class="col-md-6 col-sm-12 col-xs-12 col-narrow">
	<div class="shop-item">
		<a href="{{ URL::to('product/'.$wideModelId) }}" class="shop-item-image wide-home-display">
			<img src="{{ asset('images/lazyload-holder.png') }}" 
			data-original="{{ asset('images/model-poster/'.$wideModelId.'.jpg') }}" 
			class="lazy">
		</a>
	</div>
</div>
