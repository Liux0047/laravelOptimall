@extends ('layouts.base')

@section('link-css')
@parent
{{ HTML::style('plugins/raty-2.7.0/jquery.raty.css') }}
@stop

@section ('content')
<div class="container content-container content-no-header">
	{{ Form::open(array('action'=>'ProductController@getGallery', 'method' => 'get', 'id'=>'product_gallery_form')) }}
	
	<div class="row row-narrow">

		<div class="col-md-2">
			@include('components.product-page.gallery-filter', array('styles'=>$styles, 'categories'=>$categories, 'shapes'=>$shapes, 'materials'=>$materials,'genders'=>$genders, 'frames'=>$frames,'colors'=>$colors, 'checkedValues'=>$checkedValues))
		</div>

		<div class='col-md-10 col-narrow'>
			<div class="shop-items-container">
				<div class="panel panel-default" id="options">
					<div class="panel-heading">		
						<a class="sorting-option @if ($sortOrder == 'num_items_sold_display') selected-sorting-option @endif" href="javascript:submitSortOrder('num_items_sold_display', 1);">
							销量优先
						</a> 
						<a class="sorting-option @if ($sortOrder == 'average_design_rating') selected-sorting-option @endif" href="javascript:submitSortOrder('average_design_rating', 1);">
							评分：由高到低
						</a>
						<a class="sorting-option @if ($sortOrder == 'price' && $isDesc == true) selected-sorting-option @endif" href="javascript:submitSortOrder('price', 1);">
							价格优先：<i class="fa fa-arrow-down"></i>
						</a> 
						<a class="sorting-option @if ($sortOrder == 'price' && $isDesc == false) selected-sorting-option @endif" href="javascript:submitSortOrder('price', 0);">
							价格优先：<i class="fa fa-arrow-up"></i>
						</a> 
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
@stop


@section('script')
@parent
@include('components.product-page.product-card-js')

<script type="text/javascript">

function submitSortOrder(orderName, isDesc){
	$('#options').append("<input type='hidden' name='sort_order' value="+ orderName +">");   
	if (isDesc){
		$('#options').append("<input type='hidden' name='is_desc' value='1'>");   
	}	
	else {
		$('#options').append("<input type='hidden' name='is_desc' value='0'>");
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
		ratyInit();
		$("img.lazy").lazyload();
		$(".color-icon-link").click(colorIconClickFunc);		
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

</script>
@stop