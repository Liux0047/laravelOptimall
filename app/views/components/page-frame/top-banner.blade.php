<div class="top-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-8 col-xs-8">
                <div class="logo">
                    <a href="{{ URL::to('/') }}" title="Return to the homepage">
                        {{ HTML::image('images/optimall.png', 'Optimall logo') }} 
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-sm-1 col-xs-1">
                <div class="row">
                    <div class="col-md-3 optimall-promises">                                
                        <h6><i class="fa fa-check-square-o fa-lg"></i> Best Value for Money</h6>
                    </div>
                    <div class="col-md-3 optimall-promises">
                        <h6><i class="fa fa-check-square-o fa-lg"></i> 10-Day Exchange</h6>
                    </div>
                    <div class="col-md-3 optimall-promises">
                        <h6><i class="fa fa-check-square-o fa-lg"></i> Cash on Delivery</h6>
                    </div>
                    <div class="col-md-3 optimall-promises">
                        <h6><i class="fa fa-check-square-o fa-lg"></i> Secured Checkout</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3 cart-icon-ontainer">
                <a href="{{ action('ShoppingCartController@getMyCart') }}" >
                    {{ HTML::image('images/cart-icon.png', 'Cart Icon') }} 
                </a>
                <span class="badge">{{ $numCartItems }}</span>  
            </div>
        </div>
    </div>
</div>