<div class="top-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-4 col-xs-4">
                <div class="logo">
                    <a href="{{ URL::to('/') }}" title="Return to the homepage">
                        {{ HTML::image('images/optimall.png', 'Optimall logo') }} 
                    </a>
                </div>
            </div>
            <div class="col-md-8 col-sm-4 col-xs-4">
                <div class="row row-narrow">
                    <div class="col-md-2 optimall-promises col-narrow">                                
                        <h6><i class="fa fa-check-square-o fa-lg"></i> 100%正品保障</h6>
                    </div>
                    <div class="col-md-2 optimall-promises col-narrow">
                        <h6><i class="fa fa-truck fa-lg"></i> 全场商品包邮</h6>
                    </div>
                    <div class="col-md-2 optimall-promises col-narrow">
                        <h6><i class="fa fa-exchange fa-lg"></i> 30天随心退换</h6>
                    </div>
                    <div class="col-md-2 optimall-promises col-narrow">
                        <h6><i class="fa fa-lock fa-lg"></i> 安全担保交易</h6>
                    </div>
                    <div class="col-md-2 optimall-promises col-narrow">
                        <h6><i class="fa fa-thumbs-o-up fa-lg"></i> 最佳用户体验</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-1 col-sm-4 col-xs-4 cart-icon-container">
                <a href="{{ action('ShoppingCartController@getMyCart') }}" >
                    <i class="fa fa-shopping-cart fa-2x"></i> 
                </a>
                <span class="badge" id="num_cart_items">{{ $numCartItems }}</span>
            </div>
        </div>
    </div>
</div>