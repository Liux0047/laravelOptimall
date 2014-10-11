@extends ('layouts.base')

@section('link-css')
@parent
{{ HTML::style('plugins/clean-canvas/css/compiled/slider.css'); }}
{{ HTML::style('plugins/clean-canvas/css/lib/animate.css'); }}
{{ HTML::style('plugins/raty-2.7.0/jquery.raty.css') }}
@stop

@section ('content')

<section id="feature_slider" class="lol">
    <!--
        Each slide is composed by <img> and .info
        - .info's position is customized with css in index.css
        - each <img> parallax effect is declared by the following params inside its class:

        example: class="asset left-472 sp600 t120 z3"
        left-472 means left: -472px from the center
        sp600 is speed transition
        t120 is top to 120px
        z3 is z-index to 3
        Note: Maintain this order of params

        For the backgrounds, you can combine from the bgs folder :D
    -->
    <article class="slide" id="showcasing" style="background-image: url('{{  asset('images/carousel/backgrounds/bg.jpg') }}');">
        <img class="asset left-595 sp600 t55 z1" src="{{ asset('images/carousel/slides/scene2/glasses.png') }}" />
        <img class="asset left50 sp600 t200 z1" src="{{ asset('images/carousel/slides/scene2/words.png') }}" />
        <img class="asset left300 sp600 t50 z1" src="{{ asset('images/carousel/slides/scene2/price.png') }}" />
        <div class="info">
            <h2></h2>
        </div>
    </article>

    <article class="slide" id="ideas" style="background-image: url('{{  asset('images/carousel/index-carousel-cn-1.jpg') }}');">
        <div class="info">
            <h2></h2>
        </div>
    </article>

    <article class="slide" id="tour" style="background-image: url('{{  asset('images/carousel/index-carousel-cn-2.jpg') }}');">
        <div class="info">
            <h2></h2>
        </div>
    </article>

    <article class="slide" id="responsive" style="background-image: url('{{  asset('images/carousel/index-carousel-cn-3.jpg') }}');">
        <div class="info">
            <h2></h2>
        </div>
    </article>

    <article class="slide" id="random" style="background-image: url('{{  asset('images/carousel/index-carousel-cn-4.jpg') }}');">
        <div class="info">
            <h2></h2>
        </div>
    </article>

    <article class="slide" id="tobedecided" style="background-image: url('{{  asset('images/carousel/index-carousel-cn-5.jpg') }}');">
        <div class="info">
            <h2></h2>
        </div>
    </article>



</section>



<div class="container content-container">
    <div class="shop-items-container" id="promotion-section">
        <div class="container">
            <h1 class="shelf-header">
                <span class="title">
                    促销 
                    {{ HTML::image('images/section-tags/section-tag-1.png') }}
                </span>
                <span class="divider"></span>
            </h1>
            <div class="row row-narrow">
                @include('components.product-page.product-card-wide', array('quote'=>$wideModelQuote, 'wideModel' => $wideModels['promotion'][0]))

                @for ($i=0; $i<2; $i++)
                @include('components.product-page.product-card', array('model' => $promotionModels[$i] ))
                @endfor
            </div>
            <div class="row row-narrow">
                @include('components.product-page.product-card-wide', array('quote'=>$wideModelQuote, 'wideModel' => $wideModels['promotion'][1]))

                @for ($i=2; $i<4; $i++)
                @include('components.product-page.product-card', array('model' => $promotionModels[$i] ))
                @endfor
            </div>
        </div>
    </div>
    <div class="shop-items-container" id="best-seller-section">
        <div class="container">
            <h1 class="shelf-header">
                <span class="title">
                    热卖 
                    {{ HTML::image('images/section-tags/section-tag-2.png') }}
                </span>
                <span class="divider"></span>
            </h1>
            <div class="row row-narrow">                
                @for ($i=0; $i<2; $i++)
                @include('components.product-page.product-card', array('model' => $bestSellerModels[$i]))
                @endfor

                @include('components.product-page.product-card-wide', array('quote'=>$wideModelQuote, 'wideModel' => $wideModels['bestSeller'][0]))

            </div>
            <div class="row row-narrow">               
                @for ($i=2; $i<4; $i++)
                @include('components.product-page.product-card', array('model' => $bestSellerModels[$i]))
                @endfor

                @include('components.product-page.product-card-wide', array('quote'=>$wideModelQuote, 'wideModel' => $wideModels['bestSeller'][1]))
            </div>
        </div>
    </div>
    <div class="shop-items-container" id="new-arrival-section">
        <div class="container">
            <h1 class="shelf-header">
                <span class="title">
                    新品 
                    {{ HTML::image('images/section-tags/section-tag-3.png') }}
                </span>
                <span class="divider"></span>
            </h1>
            <div class="row row-narrow">
                @include('components.product-page.product-card-wide', array('quote'=>$wideModelQuote, 'wideModel' => $wideModels['newArrival'][0]))

                @for ($i=0; $i<2; $i++)
                @include('components.product-page.product-card', array('model' => $newArrivalModels[$i] ))
                @endfor
            </div>
            <div class="row row-narrow">
                @include('components.product-page.product-card-wide', array('quote'=>$wideModelQuote, 'wideModel' => $wideModels['newArrival'][1]))

                @for ($i=2; $i<4; $i++)
                @include('components.product-page.product-card', array('model' => $newArrivalModels[$i] ))
                @endfor
            </div>
        </div>
    </div>
    <div class="shop-items-container"  id="featured-section">
        <div class="container">
            <h1 class="shelf-header">
                <span class="title">
                    推荐 
                    {{ HTML::image('images/section-tags/section-tag-4.png') }}
                </span>
                <span class="divider"></span>
            </h1>
            <div class="row row-narrow">                
                @for ($i=0; $i<2; $i++)
                @include('components.product-page.product-card', array('model' => $featuredModels[$i] ))
                @endfor

                @include('components.product-page.product-card-wide', array('quote'=>$wideModelQuote, 'wideModel' => $wideModels['featured'][0]))

            </div>
            <div class="row row-narrow">               
                @for ($i=2; $i<4; $i++)
                @include('components.product-page.product-card', array('model' => $featuredModels[$i] ))
                @endfor

                @include('components.product-page.product-card-wide', array('quote'=>$wideModelQuote, 'wideModel' => $wideModels['featured'][1]))
            </div>
        </div>
    </div>
    <div class="shop-items-container" id="classical-section">
        <div class="container">
            <h1 class="shelf-header">
                <span class="title">
                    经典 
                    {{ HTML::image('images/section-tags/section-tag-5.png') }}
                </span>
                <span class="divider"></span>
            </h1>
            <div class="row row-narrow">
                @include('components.product-page.product-card-wide', array('quote'=>$wideModelQuote, 'wideModel' => $wideModels['classical'][0]))

                @for ($i=0; $i<2; $i++)
                @include('components.product-page.product-card', array('model' => $classicalModels[$i] ))
                @endfor
            </div>
            <div class="row row-narrow">
                @include('components.product-page.product-card-wide', array('quote'=>$wideModelQuote, 'wideModel' => $wideModels['classical'][1]))

                @for ($i=2; $i<4; $i++)
                @include('components.product-page.product-card', array('model' => $classicalModels[$i] ))
                @endfor
            </div>
        </div>
    </div>

    <div class="row style-icon-container">
        @for($i=1; $i<=6; $i++)
        <div class="col-md-2 col-sm-4 col-xs-4">
            <a href="{{ url('gallery?styles[]='.$i) }}">
                <img src="{{ asset('images/lazyload-holder.png') }}" 
                data-original="{{ asset('images/styles/style-'.$i.'.jpg') }}" 
                class="lazy style-icon retina-alt">
            </a>
        </div>
        @endfor
    </div>            
</div>
@stop

@section('link-script')
@parent
{{ HTML::script('plugins/clean-canvas/js/theme.js') }}
{{ HTML::script('plugins/clean-canvas/js/index-slider.js') }}
{{ HTML::script('plugins/raty-2.7.0/jquery.raty.js') }}
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
@include('components.product-page.product-card-js')

@stop
