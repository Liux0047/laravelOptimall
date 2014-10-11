<div id="index-carousel" class="carousel slide">                        
    <!-- Indicators -->
    <ol class="carousel-indicators">                
        <li data-target="#index-carousel" data-slide-to="0" class="active"></li> 
        <li data-target="#index-carousel" data-slide-to="1"></li> 
        <li data-target="#index-carousel" data-slide-to="2"></li> 
        <li data-target="#index-carousel" data-slide-to="3"></li>             
        <li data-target="#index-carousel" data-slide-to="4"></li>
    </ol>
    <!-- Carousel items -->
    <div class="carousel-inner">
        <div class="active item">
            <a href="{{ action('InfoController@getAboutProducts') }}">
                <img src="{{ asset('images/carousel/index-carousel-cn-1.jpg') }}">
            </a>
        </div>
        <div class="item">
            <a href="{{ action('InfoController@getAmbassadorIntro') }}">
                <img data-lazy-load-src="{{ asset('images/carousel/index-carousel-cn-2.jpg') }}">
            </a>
        </div>
        <div class="item">
            <a href="{{ action('ProductController@getProduct', array(3001)) }}">
                <img data-lazy-load-src="{{ asset('images/carousel/index-carousel-cn-3.jpg') }}">
            </a>
        </div>
        <div class="item">
            <a href="{{ action('ProductController@getProduct', array(1009)) }}">
                <img data-lazy-load-src="{{ asset('images/carousel/index-carousel-cn-4.jpg') }}">
            </a>
        </div>
        <div class="item">
            <a href="{{ action('ProductController@getProduct', array(1009)) }}">
                <img data-lazy-load-src="{{ asset('images/carousel/index-carousel-cn-5.jpg') }}">
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

<article class="slide" id="ideas" style="background-image: url('{{  asset('images/carousel/backgrounds/aqua.jpg') }}');">
    <div class="info">
        <h2>第二张图片</h2>
    </div>
    <img class="asset left-480 sp600 t180 z1" src="{{ asset('images/carousel/slides/scene2/left.png') }}" />
    <img class="asset left-210 sp600 t133 z2" src="{{ asset('images/carousel/slides/scene2/middle.png') }}" />
    <img class="asset left60 sp600 t180 z1" src="{{ asset('images/carousel/slides/scene2/right.png') }}" />
</article>
<article class="slide" id="tour" style="background-image: url('{{  asset('images/carousel/backgrounds/color-splash.jpg') }}');">
    <img class="asset left-472 sp650 t110 z3" src="{{ asset('images/carousel/slides/scene3/ipad.png') }}" />
    <img class="asset left-365 sp600 t170 z4" src="{{ asset('images/carousel/slides/scene3/iphone.png') }}" />
    <img class="asset left-350 sp450 t35 z2" src="{{ asset('images/carousel/slides/scene3/desktop.png') }}" />
    <img class="asset left-185 sp550 t120 z1" src="{{ asset('images/carousel/slides/scene3/macbook.png') }}" />
    <div class="info">
        <h2>完全是 使用多设备 的</h2>
        <a href="features.html">浏览产品</a>
    </div>
</article>
<article class="slide" id="responsive" style="background-image: url('{{  asset('images/carousel/backgrounds/indigo.jpg') }}');">
    <img class="asset left-472 sp600 t60 z3" src="{{ asset('images/carousel/slides/scene4/html5.png') }}" />
    <img class="asset left-190 sp500 t60 z2" src="{{ asset('images/carousel/slides/scene4/css3.png') }}" />
    <div class="info">
        <h2>
            多设备 <strong>兼容的网页</strong>
            主题
        </h2>
    </div>
</article>