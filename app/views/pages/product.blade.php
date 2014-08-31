@extends ('layouts.base')

@section('link-css')
@parent
{{ HTML::style('plugins/fotorama-4.5.2/fotorama.css') }}
@stop

@section ('content')
<div class="container content-container content-no-header">
    @include('components.product-page.progress-tracker', array('progtrckrStep' => 1))
    <br>
    <div class="row">    
        <div class="col-md-8" id="product_pic_container">   
            <div class="fotorama"  data-allowfullscreen="native"  data-auto="false">
                @for ($i = 1; $i <= 4; $i++)
                <a href="{{ asset('images/gallery/'.$model->model_id.'/'.$product->product_id.'/medium-view-'.$i.'.jpg') }}" 
                 data-thumb="{{ asset('images/gallery/'.$model->model_id.'/'.$product->product_id.'/medium-view-'.$i.'.jpg') }}" 
                 data-full="{{ asset('images/gallery/'.$model->model_id.'/'.$product->product_id.'/large-view-'.$i.'.jpg') }}">           
             </a>  
             @endfor      
         </div>
     </div>
     <div class="col-md-4">
        <h3>
            <strong>{{ $model->model_name_cn }}</strong>
            <small class="font-brown">
                <i>                            
                    {{ $model->style_name_cn }}
                    {{ $model->material_name_cn }}
                    {{ $model->frame_name_cn }}
                </i>
            </small>                        
        </h3>

        {{ Form::open(array('action' => 'ShoppingCartController@postAddItem', 'class'=>'form', 'id'=>'')) }}
        <table class="view-item-table">
            <thead>
                <tr>
                    <td width="20%"></td><td></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="font-grey">价格</span></td>
                    <td>
                        <span class="price-prominent">
                            ¥
                            <span id="sales-price" class="sales-price">
                                {{ number_format($model->price, 2) }}
                            </span>      
                            <span class='label label-danger'>促销</span> 
                            (市场价 ¥<del id='market-price'>{{ number_format($model->price * 1.5, 2) }}</del>)   
                        </span>                               
                    </td>
                </tr>
                <tr>
                    <td><span class="font-grey">评价</span></td>
                    <td class="review-cell" >      
                        目前没有评论
                    </td>
                </tr>
                <tr>
                    <td><span class="font-grey">库存状况</span></td>
                    <td>
                        <span class="font-brown">有现货，下单后立即发货</span>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class='row font-brown'>
            <div class='col-md-4'>
                <i class='fa fa-calendar'></i> 
                月销量: {{ $model->num_items_sold_display }} 件
            </div>
            <div class='col-md-7'>
                <i class='fa fa-truck'></i> 
                预计配送时间: 3-5 工作日
            </div>
        </div>
        <hr>

        <table class="view-item-table">
            <thead>
                <tr>
                    <td width="20%"></td><td></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="font-grey">选择颜色</span></td>
                    <td>
                        @for ($i=0; $i<count($products); $i++)
                        <div class="selection-box color-selection-box 
                        @if ($i == 0) 
                        selected
                        @endif
                        " id="color_{{ $products[$i]->product_id }}" onclick='changeColor({{ $products[$i]->product_id }});' >
                        <img src="{{ asset('images/color/color-'.$products[$i]->color.'.png') }}">
                        {{ $products[$i]->color_name_cn }}
                        <i class='fa fa-check'></i>
                    </div>
                    @endfor                           
                    <input type="hidden" name="product_id" value="{{ $products[0]->product_id }}">   
                    <br>
                </td>
            </tr>
            <tr><td class="table-separator"></td></tr>
            <tr>
                <td><span class="font-grey">选择镜片</span></td>
                <td>
                    @for ($i=0; $i<count($lensTypes); $i++)
                    <div class="lens-selection-container">
                       <div class="selection-box lens-selection-box 
                       @if ($i == 0) 
                       selected
                       @endif
                       " id="lens_{{ $lensTypes[$i]->lens_type_id }}" 
                       onclick="changeLens({{ $lensTypes[$i]->lens_type_id }}, {{ $lensTypes[$i]->price }}, {{ $model->price }}, {{ $model->price * 1.5 }});" > 
                       {{ $lensTypes[$i]->title_cn }} 
                       (套餐价:<strong>¥{{ number_format($lensTypes[$i]->price, 2) }}</strong>)
                       <i class='fa fa-check'></i>
                   </div>
                   <a href="#" data-toggle="popover"  data-title="{{ $lensTypes[$i]->title_cn }}" 
                    data-content="{{ $lensTypes[$i]->description_cn }}" >
                    <i class='fa fa-info-circle fa-lg'></i> 
                </a>
            </div>
            @endfor
            <input type="hidden" name="lens_type" value="{{ $lensTypes[0]->lens_type_id }}">
        </td>
    </tr>
    <tr><td class="table-separator"></td></tr>
    <tr>
        <td></td>
        <td>
            <button class='btn btn-danger' type='submit' ><i class='fa fa-shopping-cart'></i> 加入购物车</button>                                       
        </td>
    </tr>
</tbody>                            
</table>              
{{ Form::close() }}
</div>
</div>

@include('components.product-page.product-info', array('model' => $model))
</div>

@stop

@section("link-script")
@parent
{{ HTML::script('plugins/raty-2.5.2/jquery.raty.min.js') }}
{{ HTML::script('plugins/fotorama-4.5.2/fotorama.js') }}
@stop

@section("script")
@parent
<script type="text/javascript">
var fotoramaInit = function() {
    $('.fotorama').fotorama({
        width: 700,
        maxwidth: '100%',
        ratio: 16 / 9,
        allowfullscreen: 'native',
        nav: 'thumbs',
        navposition: 'bottom',
        autoplay: true,
        thumbwidth: 96,
        thumbheight: 64
    });
}
fotoramaInit();

    //change color option box based on click
    function changeColor(productId) {
        $(".color-selection-box").removeClass("selected");
        $(".color-selection-box#color_" + productId).addClass("selected");
        //change the hidden input value
        $("input[name='product_id']").val(productId);
        changeProductPic(productId);
    }
    
    //chnage product pic after color choice
    function changeProductPic(productId) {
        $("#product_pic_container").html("");
        $("#product_pic_container").append("<div class='fotorama' data-allowfullscreen='native'  data-auto='false'>");
        @for ($i=1; $i<=4; $i++)            
        $("#product_pic_container .fotorama").append(
            "<a href='{{ asset('images/gallery/'.$model->model_id) }}/" + productId + "/medium-view-{{ $i }}.jpg' " +
            "data-thumb='{{ asset('images/gallery/'.$model->model_id) }}/" + productId + "/medium-view-{{ $i }}.jpg' " +
            "data-full='{{ asset('images/gallery/'.$model->model_id) }}/" + productId + "/large-view-{{ $i }}.jpg'> "
            );
        @endfor
        $("#product_pic_container").append("</div>");
        fotoramaInit();       
    }
    
    //change lens based on click
    function changeLens(lensId, lensPrice, basePrice, baseMarketPrice) {
        $(".lens-selection-box").removeClass("selected");
        $(".lens-selection-box#lens_" + lensId).addClass("selected");
        //change the hidden input value
        $("input[name='lens_type']").val(lensId);
        //change the sales price
        var newPrice = basePrice + lensPrice;
        document.getElementById("sales-price").innerHTML = newPrice.toFixed(2);
        //change the markete price
        var newMarketPrice = baseMarketPrice + lensPrice;
        document.getElementById("market-price").innerHTML = newMarketPrice.toFixed(2);
    }

    //enable popover
    $(document).ready(function() {
        $('.lens-selection-container a').popover({
            trigger: 'hover',
            html: 'true',
            placement: 'bottom',
            container: 'body'
        });
    });

    //scroll to tab content
    $('#review_count_button').click(function(e) {
        e.preventDefault();
        $("#user_review_tab").trigger("click");
        $('html, body').animate({
            scrollTop: ($('.nav-tabs').offset().top) - 100
        }, 1000);
        return false;
    });


    </script>       
    @stop
