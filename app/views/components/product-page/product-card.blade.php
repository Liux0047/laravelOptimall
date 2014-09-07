<div class="col-md-3 col-sm-6 col-xs-6">
    <div class="shop-item">
        @if ($model->product_label_id == 0)
        <span class="item-badge promotion-badge"></span>
        @elseif ($model->product_label_id == 1)
        <span class="item-badge best-seller-badge"></span>
        @elseif ($model->product_label_id == 2)
        <span class="item-badge new-arrival-badge"></span>
        @elseif ($model->product_label_id == 3)
        <span class="item-badge featured-badge"></span>
        @elseif ($model->product_label_id == 4)
        <span class="item-badge classical-badge"></span>
        @endif
        <div class="shop-item-label">
            <div class="pull-left">
                <span class="discount-price">
                    {{ number_format($model->price, 0) }} 
                </span>
                <span class="market-price"><del>¥{{ $model->price + 300 }}</del>
                </span>
            </div>
        </div>
        <div class="shop-item-image item-image-single">
            <a href="{{ URL::to('product/'.$model->model_id) }}" id="small-view-{{ $model->model_id }}">
                <img src="{{ asset('images/lazyload-holder.png') }}" 
                data-original="{{ asset('images/gallery/'.$model->model_id.'/'.$model->productViews()->first()->product_id.'/medium-view-3.jpg') }}" 
                class="lazy">
            </a>
        </div>
        <div class="shop-item-details">
            <h5>{{ $model->model_name_cn }}</h5>
            <p>
                @foreach( $model->productViews as $product)
                <span onclick="changeSmallImg({{ $model->model_id }}, {{ $product->product_id }});" class="color-icon-link"> 
                    <img src="{{ asset('images/color/color-'.$product->product_color_id.'.png') }}" class="color-icon">
                </span>
                @endforeach
            </p>
        </div>
        <div class="info-bar-hover">
            <a href="{{ URL::to('product/'.$model->model_id) }}">
                评分: 
                <div id="star_id_{{ $model->model_id }}" class="raty-star" 
                    @if (($model->average_design_rating + $model->average_comfort_rating + $model->average_quality_rating) > 0)
                    data-score="{{ ($model->average_design_rating + $model->average_comfort_rating + $model->average_quality_rating) / 3 }}",
                    @else
                    data-score="5" 
                    @endif
                    >                         
                </div>
            </a>
        </div>
    </div>
</div>
