@extends ('layouts.base')

@section('link-css')
@parent
{{ HTML::style('plugins/raty-2.7.0/jquery.raty.css') }}
{{ HTML::style('plugins/jquery-ui-slider/jquery-ui.min.css') }}
@stop

@section ('content')
<div class="container content-container content-no-header">
	{{ Form::open(array('action'=>'ProductController@getGallery', 'method' => 'get', 'id'=>'product_gallery_form')) }}
	
	<div class="row row-narrow">

		<div class="col-md-2">
			@include('components.product-page.gallery-filter', array('filters'=>$filters, 'filterValues'=>$filterValues, 'checkedValues'=>$checkedValues))
		</div>

		<div class='col-md-10 col-narrow'>

            @if(Input::has('search_keyword'))
            <p>
            与 <strong>“{{ Input::get('search_keyword') }}”</strong> 相关的产品：
            {{ Form::hidden('search_keyword', Input::get('search_keyword')) }}
            </p>
            @endif

			<div class="shop-items-container">
				<div class="panel panel-default" id="gallery_options">
					<div class="panel-heading">
                        <div class="row">
                            <div class="col-md-5 col-sm-12 col-xs-12">

                                <button type="button" class="btn btn-xs @if ($sortOrder == 'num_items_sold_display') btn-success @else btn-default @endif"
                                    onclick="submitSortOrder('num_items_sold_display', 1);">
                                    销量优先：<i class="fa fa-arrow-down"></i>
                                </button>

                                <button type="button" class="btn btn-xs @if ($sortOrder == 'average_design_rating') btn-success @else btn-default @endif"
                                    onclick="submitSortOrder('average_design_rating', 1);">
                                    评分优先：<i class="fa fa-arrow-down"></i>
                                </button>

                                <button type="button" class="btn btn-xs @if ($sortOrder == 'price' && $isDesc == true) btn-success @else btn-default @endif"
                                    onclick="submitSortOrder('price', 1);">
                                    价格优先：<i class="fa fa-arrow-down"></i>
                                </button>

                                <button type="button" class="btn btn-xs @if ($sortOrder == 'price' && $isDesc == false) btn-success @else btn-default @endif"
                                    onclick="submitSortOrder('price', 0);">
                                    价格优先：<i class="fa fa-arrow-up"></i>
                                </button>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3 padding-align align-right">
                                <label for="price_min">价格范围:</label>
                                <strong class="rmb-sign">￥</strong><span id="price_min_display"></span> <strong>-</strong>
                                <strong class="rmb-sign">￥</strong><span id="price_max_display"></span>
                                <input type="hidden" id="price_min" name="price_min">
                                <input type="hidden" id="price_max" name="price_max">
                            </div>

                            <div class="col-md-3 col-sm-7 col-xs-7 padding-align">
                                <div id="price_range_slider"></div>
                            </div>

                            <div class="col-md-1 col-sm-1 col-xs-1">
                                <button type="button" class="btn btn-xs btn-success"
                                    onclick="document.getElementById('product_gallery_form').submit();">
                                    更新
                                </button>
                            </div>
                        </div>
                    </div>

					<div class="panel-body" id="product_cards_container">
						@if($models->count())
						@foreach ($models as $model)
						@include('components.product-page.product-card', array('model' => $model, 'colMd' => 4))
						@endforeach
						@else
						很抱歉，没有找到符合条件的眼镜，请尝试减少一些筛选条件
						@endif
					</div>

					<div class="panel-footer">
						<div class="align-center">
							<button onclick="loadMoreModels(); return false;" class="btn btn-success" id="load_more_btn">
								加载更多	{{ HTML::image('images/preloader-white.gif','loading',array('class'=>'ajax-preloader no-display', 'id'=>'load_more_preloader_img'))}}			
							</button>													
						</div>						
					</div>
				</div>

			</div>

		</div>
	</div>
	{{ Form:: close() }}
</div>
@stop


@section('link-script')
@parent
{{ HTML::script('plugins/raty-2.7.0/jquery.raty.js') }}
{{ HTML::script('plugins/jquery-ui-slider/jquery-ui.min.js') }}
@stop


@section('script')
@parent
@include('components.product-page.product-card-js')

<script type="text/javascript">

function submitSortOrder(orderName, isDesc){
	$('#gallery_options').append("<input type='hidden' name='sort_order' value="+ orderName +">");
	if (isDesc){
		$('#gallery_options').append("<input type='hidden' name='is_desc' value='1'>");
	}	
	else {
		$('#gallery_options').append("<input type='hidden' name='is_desc' value='0'>");
	}
	document.getElementById("product_gallery_form").submit();
}

//change collpase fa icon on dropdown 
$('.gallery-filter-container .collapse').each(function(){
	if ($(this).hasClass("in")){
		$(this).prev('a').find('.fa.fa-caret-right').removeClass('fa-caret-right').addClass('fa-caret-down');
	}
	$(this).on('show.bs.collapse', function () {
		$(this).prev('a').find('.fa.fa-caret-right').removeClass('fa-caret-right').addClass('fa-caret-down');
	});
	$(this).on('hide.bs.collapse', function () {
		$(this).prev('a').find('.fa.fa-caret-down').removeClass('fa-caret-down').addClass('fa-caret-right');
	});
});

//ajax load more models
function loadMoreModels() {
	$("#load_more_preloader_img").show();
	$("#load_more_btn").prop('disabled', true);
	$.ajax({
		type: "POST",
		url: "{{ action('ProductController@postShowRemainingModels') }}",
		data: {},
		datatype: 'html'
	})
	.done(function(data) {            
		$("#product_cards_container").append(data);
		productCardInit();
		$("img.lazy").lazyload();
		$(".ajax-load-container").show(300, function() {
			$(this).hide().fadeIn(1000, function() {
				$('body,html').scroll();
			});
		});
	})
	.fail(function() {
        //if the connection to database failed
        alert("connection to database has failed");
    })
	.always(function() {
        //
        $("#load_more_preloader_img").hide();
    });
}

// jquery range slider
$(function() {
    var values = [{{ $price_min }}, {{ $price_max }}];

    $( "#price_range_slider" ).slider({
        range: true,
        min: '{{ ProductController::MIN_FILTER_PRICE }}',
        max: '{{ ProductController::MAX_FILTER_PRICE }}',
        values: values,
        slide: function( event, ui ) {
            $( "#price_min" ).val( ui.values[ 0 ]);
            $( "#price_max" ).val( ui.values[ 1 ]);
            $( "#price_min_display" ).html( ui.values[ 0 ]);
            $( "#price_max_display" ).html( ui.values[ 1 ]);
        }
    });
    $( "#price_min" ).val( $( "#price_range_slider" ).slider( "values", 0 ));
    $( "#price_max" ).val( $( "#price_range_slider" ).slider( "values", 1 ));
    $( "#price_min_display" ).html( $( "#price_range_slider" ).slider( "values", 0 ));
    $( "#price_max_display" ).html( $( "#price_range_slider" ).slider( "values", 1 ));
});

</script>
@stop