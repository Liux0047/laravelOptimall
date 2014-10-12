<div class="col-md-6 col-sm-12 col-xs-12 col-narrow">
	<div class="shop-item">
		<div class="wide-home-display">
			<div class="card-salient">
				<a href="{{ action('ProductController@getProduct', array($wideModel->model_id)) }}">
					<img src="{{ asset(Config::get('optimall.lazyloadImg')) }}" 
					data-original="{{ asset('images/model-poster/'.$wideModel->model_id.'.jpg') }}" 
					class="lazy retina-alt">
				</a>
			</div>
			<div class="card-hidden">
				<div class="row row-narrow">
					<div class="col-md-6 col-narrow">
						<div class="shop-item-label">
							<div class="price-label">
								<span class="discount-price">
									{{ number_format($wideModel->price, 0) }} 
								</span>
								<span class="market-price"><del>￥{{ $wideModel->price + 300 }}</del>
								</span>
							</div>
						</div>
						<div class="wide-model-quote">
							<p>
								<i class="fa fa-quote-left"></i>
								{{ $quote[$wideModel->model_id] }}
								<i class="fa fa-quote-right"></i>
							</p>
						</div>						
					</div>
					@include('components.product-page.product-card', array('model' => $wideModel, 'colMd'=>6 ))
				</div>
			</div>
		</div>
	</div>
</div>

