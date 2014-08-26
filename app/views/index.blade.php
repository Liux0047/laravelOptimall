@extends ('layouts.customer-base')

@section ('content')
<div id="index-carousel" class="carousel slide">                        
    <!-- Indicators -->
    <ol class="carousel-indicators">                
        <li data-target="#index-carousel" data-slide-to="0" class="active"></li> 
        <li data-target="#index-carousel" data-slide-to="1"></li> 
        <li data-target="#index-carousel" data-slide-to="2"></li> 
        <li data-target="#index-carousel" data-slide-to="3"></li>             
    </ol>
    <!-- Carousel items -->
    <div class="carousel-inner">
        <div class="active animated fadeInRight item">
            <a href="#">
                <img src="{{ asset('images/carousel/index-carousel-cn-1.jpg') }}">
            </a></div>
        <div class="item">
            <a href="#">
                <img data-lazy-load-src="{{ asset('images/carousel/index-carousel-cn-2.jpg') }}">
            </a>
        </div>
        <div class="item">
            <a href="#">
                <img data-lazy-load-src="{{ asset('images/carousel/index-carousel-cn-3.jpg') }}">
            </a>
        </div>
        <div class="item">
            <a href="#">
                <img data-lazy-load-src="{{ asset('images/carousel/index-carousel-cn-4.jpg') }}">
            </a>
        </div>                            
    </div>
    <!-- Controls -->
    <a class="left carousel-control" href="#index-carousel" data-slide="prev">
        <span class="icon-prev"></span>
    </a>
    <a class="right carousel-control" href="#index-carousel" data-slide="next">
        <span class="icon-next"></span>
    </a>
</div>


<div class="container content-container">
    <div class="shop-items-container">
        <div class="container">
            <h1 class="shelf-header">
                <span class="title">
                    <a href="#">
                        促销 
                        {{ HTML::image('images/section-tags/section-tag-1.png') }}
                    </a>
                </span>
                <span class="divider"></span>
            </h1>
            <div class="row">
                @include('components.product-page.product-card-wide', array('wideModelId' => $wideModelIds['promotion'][0]))

                @for ($i=0; $i<2; $i++)
                @include('components.product-page.product-card', 
                    array('model' => $promotionModels[$i], 'products' => $products)
                    )
                @endfor
            </div>
            <div class="row">
                @include('components.product-page.product-card-wide', array('wideModelId' => $wideModelIds['promotion'][1]))

                @for ($i=2; $i<4; $i++)
                @include('components.product-page.product-card', 
                    array('model' => $promotionModels[$i], 'products' => $products)
                    )
                @endfor
            </div>
        </div>
    </div>
    <div class="shop-items-container">
        <div class="container">
            <h1 class="shelf-header">
                <span class="title">
                    <a href="#">
                        热卖 
                        {{ HTML::image('images/section-tags/section-tag-2.png') }}
                    </a>
                </span>
                <span class="divider"></span>
            </h1>
            <div class="row">                
                @for ($i=0; $i<2; $i++)
                @include('components.product-page.product-card', 
                    array('model' => $bestSellerModels[$i], 'products' => $products)
                    )
                @endfor
                
                @include('components.product-page.product-card-wide', array('wideModelId' => $wideModelIds['bestSeller'][0]))
                
            </div>
            <div class="row">               
                @for ($i=2; $i<4; $i++)
                @include('components.product-page.product-card', 
                    array('model' => $bestSellerModels[$i], 'products' => $products)
                    )
                @endfor
                
                @include('components.product-page.product-card-wide', array('wideModelId' => $wideModelIds['bestSeller'][1]))
            </div>
        </div>
    </div>
    <div class="shop-items-container">
        <div class="container">
            <h1 class="shelf-header">
                <span class="title">
                    <a href="#">
                        新品 
                        {{ HTML::image('images/section-tags/section-tag-3.png') }}
                    </a>
                </span>
                <span class="divider"></span>
            </h1>
            <div class="row">
                @include('components.product-page.product-card-wide', array('wideModelId' => $wideModelIds['newArrival'][0]))

                @for ($i=0; $i<2; $i++)
                @include('components.product-page.product-card', 
                    array('model' => $newArrivalModels[$i], 'products' => $products)
                    )
                @endfor
            </div>
            <div class="row">
                @include('components.product-page.product-card-wide', array('wideModelId' => $wideModelIds['newArrival'][1]))

                @for ($i=2; $i<4; $i++)
                @include('components.product-page.product-card', 
                    array('model' => $newArrivalModels[$i], 'products' => $products)
                    )
                @endfor
            </div>
        </div>
    </div>
    <div class="shop-items-container ">
        <div class="container">
            <h1 class="shelf-header">
                <span class="title">
                    <a href="#">
                        推荐 
                        {{ HTML::image('images/section-tags/section-tag-4.png') }}
                    </a>
                </span>
                <span class="divider"></span>
            </h1>
            <div class="row">                
                @for ($i=0; $i<2; $i++)
                @include('components.product-page.product-card', 
                    array('model' => $featuredModels[$i], 'products' => $products)
                    )
                @endfor
                
                @include('components.product-page.product-card-wide', array('wideModelId' => $wideModelIds['featured'][0]))
                
            </div>
            <div class="row">               
                @for ($i=2; $i<4; $i++)
                @include('components.product-page.product-card', 
                    array('model' => $featuredModels[$i], 'products' => $products)
                    )
                @endfor
                
                @include('components.product-page.product-card-wide', array('wideModelId' => $wideModelIds['featured'][1]))
            </div>
        </div>
    </div>
    <div class="shop-items-container ">
        <div class="container">
            <h1 class="shelf-header">
                <span class="title">
                    <a href="#">
                        经典 
                        {{ HTML::image('images/section-tags/section-tag-5.png') }}
                    </a>
                </span>
                <span class="divider"></span>
            </h1>
            <div class="row">
                @include('components.product-page.product-card-wide', array('wideModelId' => $wideModelIds['classical'][0]))

                @for ($i=0; $i<2; $i++)
                @include('components.product-page.product-card', 
                    array('model' => $classicalModels[$i], 'products' => $products)
                    )
                @endfor
            </div>
            <div class="row">
                @include('components.product-page.product-card-wide', array('wideModelId' => $wideModelIds['classical'][1]))

                @for ($i=2; $i<4; $i++)
                @include('components.product-page.product-card', 
                    array('model' => $classicalModels[$i], 'products' => $products)
                    )
                @endfor
            </div>
        </div>
    </div>            
</div>

@stop

@section('script')
@parent
<script type="text/javascript">
    $('#index-carousel').carousel({
        interval: 5000
    });
    $('#index-carousel').on('slid.bs.carousel', lazyLoadCarousel);
    function lazyLoadCarousel() {
        var $activeImage = $('#index-carousel .active.item img');
        $activeImage.attr('src', $activeImage.data('lazy-load-src'));
        var $nextImage = $('#index-carousel .active.item').next('.item').find('img');
        $nextImage.attr('src', $nextImage.data('lazy-load-src'));
    }
    $(document).ready(function() {
        lazyLoadCarousel();
    });

</script>
@stop
