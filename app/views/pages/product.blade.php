@extends ('layouts.base')

@section('link-css')
@parent
{{ HTML::style('plugins/fotorama-4.6.2/fotorama.css') }}
{{ HTML::style('plugins/Magnific-Popup/magnific-popup.css') }}

@if($reviewOrderLineItemId)
@include('components.plugin.jquery-file-upload-css')
@endif

@stop

@section ('content')

<div class="container content-container">`
    @include('components.product-page.progress-tracker', array('progtrckrStep' => 1))
    <br>
    @include('components.page-frame.message-bar')
    <div class="row">    
        <div class="col-md-8" id="product_pic_container">   
            <div class="fotorama"  data-allowfullscreen="native"  data-auto="false">
                @foreach ($sequence as $i)
                <a href="{{ asset('images/gallery/'.$model->model_id.'/'.$product->product_id.'/medium-view-'.$i.'.jpg') }}" data-thumb="{{ asset('images/gallery/'.$model->model_id.'/'.$product->product_id.'/medium-view-'.$i.'.jpg') }}"  data-full="{{ asset('images/gallery/'.$model->model_id.'/'.$product->product_id.'/large-view-'.$i.'.jpg') }}">           
                </a>  
                @endforeach   
            </div>
        </div>
        <div class="col-md-4">
            <h3>
                <strong>{{ $model->model_name_cn }}</strong>
                <small class="font-brown">
                    <i>                            
                        {{ $model->shape_name_cn }}
                        {{ $model->frame_name_cn }}
                    </i>
                </small>                        
            </h3>

            {{ Form::open(array('action' => 'ShoppingCartController@getAddItem', 'class'=>'form','method'=>'GET')) }}
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
                                @include('components.product-page.product-label', array('productLabelId'=>$model->product_label_id))                                
                                (市场价 ¥<del id='market-price'>{{ number_format($model->market_price, 2) }}</del>)   
                            </span>                               
                        </td>
                    </tr>
                    <tr>
                        <td><span class="font-grey">评价</span></td>
                        <td class="review-cell" >    
                            @if($hasReview)  
                            <div class="review-star-container">
                                <div class="raty-star" id="star_id_{{ $model->model_id }}" 
                                    data-score="{{ ($model->average_design_rating + $model->average_comfort_rating + $model->average_quality_rating) / 3 }}">
                                </div>
                            </div>
                            <div class="reivew-count-container">
                                <a href="#" id="review_count_button" >
                                    (点击查看 {{ $reviews->count() }} 条评论)
                                </a>
                            </div>                        
                            @else
                            目前没有评论
                            @endif
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

            <div class='row font-brown font-small'>
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
                            @for ($i=0; $i<$products->count(); $i++)
                            <div class="selection-box color-selection-box @if ($i == 0) selected @endif" id="color_{{ $products[$i]->product_id }}" onclick='changeColor({{ $products[$i]->product_id }});' >
                                <img src="{{ asset('images/color/color-'.$products[$i]->product_color_id.'.png') }}">
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
                            @for ($i=0; $i<$lensTypes->count(); $i++)
                            <div class="lens-selection-container">
                                <div class="selection-box lens-selection-box @if ($i == 0) selected @endif" id="lens_{{ $lensTypes[$i]->lens_type_id }}" onclick="changeLens({{ $lensTypes[$i]->lens_type_id }}, {{ $lensTypes[$i]->price }}, {{ $model->price }}, {{ $model->market_price }});" > 
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


    <div class="product-info-container">
        <div class="row">
            <div class="col-md-9">
                @include('components.product-page.product-info', array('model' => $model, 'reviews'=>$reviews,'thumbedList'=>$thumbedList, 'hasReview'=>$hasReview))
            </div>
            <div class="col-md-3">
                @include('components.product-page.also-buy', array('alsoBuyModels'=>$alsoBuys['models']))
            </div>
        </div>
    </div>
</div>
@stop

@section("link-script")
@parent
{{ HTML::script('plugins/raty-2.7.0/jquery.raty.js') }}
{{ HTML::script('plugins/fotorama-4.6.2/fotorama.js') }}
{{ HTML::script('plugins/jQuery-Knob/jquery.knob.min.js') }}
{{ HTML::script('plugins/Magnific-Popup/jquery.magnific-popup.min.js') }}
@if($reviewOrderLineItemId)
{{ HTML::script('plugins/jQuery-Validation/jquery.validate.min.js') }}
{{ HTML::script('js/jQuery-Validation-customize.js') }}
@include('components.plugin.jquery-file-upload-js')
@endif
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
        thumbheight: 54
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
    @foreach ($sequence as $i)    
    $("#product_pic_container .fotorama").append(
        "<a href='{{ asset('images/gallery/'.$model->model_id) }}/" + productId + "/medium-view-{{ $i }}.jpg' " +
        "data-thumb='{{ asset('images/gallery/'.$model->model_id) }}/" + productId + "/medium-view-{{ $i }}.jpg' " +
        "data-full='{{ asset('images/gallery/'.$model->model_id) }}/" + productId + "/large-view-{{ $i }}.jpg'> "
        );
    @endforeach
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

    $('.raty-star').raty({
        path: "{{ asset('plugins/raty-2.7.0/images') }}",
        readOnly: true,
        halfShow: true,
        scoreName: "",
        score: function() {
            return $(this).attr('data-score');
        }
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

//toggle submit button for review reply
$(".review-reply-content").each(function(){
    $(this).on('input', function(){
        value = $(this).val();
        if(value.length > 0 && value.length <= 200){            
            $(this).parent().parent().find('.review-reply-btn').prop('disabled',false);
        }
        else {
            $(this).parent().parent().find('.review-reply-btn').prop('disabled',true);
        }
    });
});


//thumb up Ajax
function thumbUp(reviewId){
    $('#thumb_btn_' + reviewId + ' a').remove();
    $('#thumb_btn_' + reviewId).prepend(
        "<a href='javascript:removeThumbUp(" + reviewId + ")' class='thumbed'><i class='fa fa-thumbs-up fa-lg'></i></a> <span>我和</span> "
        );
    $.ajax({
        type: "POST",
        url: "{{ action('ReviewController@postThumbUp') }}",
        data: {review_id: reviewId
        },
        datatype: 'json',
        beforeSend: function(request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='token']").attr('content'));
        }
    }).done(function (data){

    }).fail(function() {
        //if the connection to database failed
        alert("connection to database has failed");
    }).always(function() {
        //
    });
}
//remove thumb up Ajax
function removeThumbUp(reviewId){
    $('#thumb_btn_' + reviewId + ' a').remove();
    $('#thumb_btn_' + reviewId + ' span').remove();
    $('#thumb_btn_' + reviewId).prepend(
        "<a href='javascript:thumbUp(" + reviewId + ")'><i class='fa fa-thumbs-o-up fa-lg'></i></a> "
        );
    $.ajax({
        type: "POST",
        url: "{{ action('ReviewController@postRemoveThumbUp') }}",
        data: {review_id: reviewId
        },
        datatype: 'json',
        beforeSend: function(request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='token']").attr('content'));
        }
    }).done(function (data){

    }).fail(function() {
        //if the connection to database failed
        alert("connection to database has failed");
    }).always(function() {
        //
    });
}


// post review reply Ajax
function postReviewReply(reviewId){
    var content = $("#review_reply_" + reviewId + " textarea.review-reply-content").val();
    $("#review_reply_" + reviewId + " .review-reply-btn").prop('disabled', true);
    $.ajax({
        type: "POST",
        url: "{{ action('ReviewController@postReviewReply') }}",
        data: {review_id: reviewId, content: content
        },
        datatype: 'json',
        beforeSend: function(request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='token']").attr('content'));
        }
    }).done(function (data){
        var element = "<p>" + data.nickname + "<span class='font-grey'>于 " + data.created_at + " 回复：</span> " + content + "</p>";
        $(element).appendTo("#review_" + reviewId + " .review-reply-container").hide().show(500);
    }).fail(function() {
        //if the connection to database failed
        alert("connection to database has failed");
    }).always(function() {
        $("#review_reply_" + reviewId + " textarea.review-reply-content").val("");
        $("#review_reply_" + reviewId).modal('hide');
        $("#review_reply_" + reviewId + " .review-reply-btn").prop('disabled', false);
    });
}

//change also buy section image 
function changeAlsoBuyImg(modelId, prodcutId) {
    $("#also_buy_" + modelId + " a.thumbnail-link img").remove();
    $("#also_buy_" + modelId + " a.thumbnail-link").append(
        "<img src='{{ asset('images/gallery') }}/" + modelId + "/" + prodcutId + "/{{ Config::get('optimall.smallViewImg') }}'>");
}

</script>  
@include('components.product-page.jquery-knob-js', array('model'=>$model))

@if($reviewOrderLineItemId)
@include('components.member-account.review-panel-js', array('itemId'=>$reviewOrderLineItemId))
@endif

@stop
