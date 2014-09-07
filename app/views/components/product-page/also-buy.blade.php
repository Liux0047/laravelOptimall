<div class="col-md-3">
    <div class="panel panel-default also-buy-container">
        <div class="panel-heading">猜你喜欢的</div>                    

        <table class="table">
            @foreach($alsoBuyModels as $alsoBuyModel)
            <tr>
                <td width="60%" id="also_buy_{{ $alsoBuyModel->model_id }}" class="also-buy-img-cell">
                    <a href="{{ action('ProductController@getProduct', [$alsoBuyModel->model_id]) }}" class="thumbnail-link">
                        <img src="{{ asset('images/lazyload-holder.png') }}" 
                        data-original="{{ asset('images/gallery/'.$alsoBuyModel->model_id.'/'.$alsoBuyModel->productViews()->first()->product_id.'/medium-view-3.jpg') }}" 
                        class="lazy">
                    </a>
                    <h5 class="model-title"><strong>{{ $alsoBuyModel->model_name_cn }}</strong></h5>
                    <a href="{{ action('ProductController@getProduct', array($alsoBuyModel->model_id)) }}">
                        去围观
                    </a>
                </td>
                <td>        
                    <p> 
                        <span class="discount-price">
                            ¥{{ number_format($alsoBuyModel->price, 0) }} 
                        </span>
                        <span class="market-price"><del>¥{{ $alsoBuyModel->price + 300 }}</del></span>                                    
                    </p>
                    <p>                                    
                        @foreach($alsoBuyModel->productViews as $product)
                        <span onclick="changeAlsoBuyImg({{ $alsoBuyModel->model_id }}, {{ $product->product_id }});"  class="color-icon-link"> 
                            <img src="{{ asset('images/color/color-'.$product->product_color_id.'.png') }}" class="color-icon">
                        </span>
                        @endforeach
                    </p>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>