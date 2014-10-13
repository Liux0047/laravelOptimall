<div class="col-md-{{ $colMd or '3' }} col-sm-{{ $colSm or '6' }} col-xs-6 col-narrow">
    <div class="shop-item">
        @if ($model->product_badge_id == 1)
        <span class="shop-item-badge promotion-badge"></span>
        @elseif ($model->product_badge_id == 2)
        <span class="shop-item-badge best-seller-badge"></span>
        @elseif ($model->product_badge_id == 3)
        <span class="shop-item-badge new-arrival-badge"></span>
        @elseif ($model->product_badge_id == 4)
        <span class="shop-item-badge featured-badge"></span>
        @elseif ($model->product_badge_id == 5)
        <span class="shop-item-badge classical-badge"></span>
        @endif
        <div class="shop-item-label">
            <div class="price-label">
                <span class="discount-price">
                    {{ number_format($model->price, 0) }} 
                </span>
                <span class="market-price rmb-sign"><del>￥{{ $model->market_price }}</del>
                </span>
            </div>
        </div>
        <div class="shop-item-image item-image-single">
            <a target="_blank" href="{{ url('product', array($model->model_id)) }}"
                class="small-view-link" id="small-view-{{ $model->model_id }}">
                <span class="vertical-align-helper"></span>
                <img src="{{ asset('images/preloader.gif') }}"
                data-original="{{ asset('images/gallery/'.$model->model_id.'/'.$model->productViews()->first()->product_id.'/'.Config::get('optimall.smallViewImg')) }}" 
                class="lazy retina-alt">
            </a>
        </div>
        <div class="shop-item-details">
            <h5>{{ $model->model_name_cn }}</h5>
            <p>
                @foreach( $model->productViews as $product)
                <span class="color-icon-link" data-model-id="{{ $model->model_id }}" data-product-id="{{ $product->product_id }}">
                    <img src="{{ asset('images/color/color-'.$product->product_color_id.'.png') }}" class="color-icon">
                </span>
                @endforeach
            </p>
        </div>
        <div class="info-bar-hover">
            <a target="_blank" href="{{ url('product', array($model->model_id)) }}">
                评分: 
                <div id="star_id_{{ $model->model_id }}" class="raty-star" 
                    @if (($model->average_design_rating + $model->average_comfort_rating + $model->average_quality_rating) > 0)
                    data-score="{{ ($model->average_design_rating + $model->average_comfort_rating + $model->average_quality_rating) / 3 }}",
                    @else
                    data-score="0" 
                    @endif
                    >                         
                </div>
            </a>
        </div>
    </div>
</div>
