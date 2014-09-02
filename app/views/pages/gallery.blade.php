@extends ('layouts.base')

@section('link-css')
@parent
{{ HTML::style('plugins/raty-2.7.0/jquery.raty.css') }}
@stop

@section ('content')
<div class="container content-container content-no-header">
	{{ Form::open(array('action'=>'productController@getGallery', 'method' => 'get', 'id'=>'product_gallery_form')) }}

	@include('components.product-page.gallery-filter', array('styles'=>$styles, 'categories'=>$categories, 'shapes'=>$shapes, 'materials'=>$materials,'genders'=>$genders, 'frames'=>$frames,'colors'=>$colors, 'checkedValues'=>$checkedValues))

	<div class="row">
		<div class="shop-items-container">
			<div class="container">
				<div class="panel panel-default" id="options">
					<div class="panel-heading">					
						<strong>排序 </strong> 

						@if ($sortOrder == 'num_items_sold_display')
						<a class="label label-primary" href="javascript:submitSortOrder('num_items_sold_display', 1);">销量优先</a> |  
						@else
						<a href="javascript:submitSortOrder('num_items_sold_display', 1);">销量优先</a> |  
						@endif

						@if ($sortOrder == 'average_design_rating')
						<a class="label label-primary" href="javascript:submitSortOrder('average_design_rating', 1);">评分：由高到低</a> |  
						@else
						<a href="javascript:submitSortOrder('average_design_rating', 1);">评分：由高到低</a> |  
						@endif

						@if ($sortOrder == 'price' && $isDesc == true)
						<a class="label label-primary" href="javascript:submitSortOrder('price', 1);">价格优先：从高到低</a> |  
						@else
						<a href="javascript:submitSortOrder('price', 1);">价格优先：从高到低</a> |  
						@endif

						@if ($sortOrder == 'price' && $isDesc == false)
						<a class="label label-primary" href="javascript:submitSortOrder('price', 0);">价格优先：从低到高</a> |  
						@else
						<a href="javascript:submitSortOrder('price', 0);">价格优先：从低到高</a> |  
						@endif
						
					</div>

					<div class="panel-body" id="product_cards_container">
						@foreach ($models as $model)
						@include('components.product-page.product-card', array('model' => $model, 'products' => $products[$model->model_id]))
						@endforeach
					</div>

					<div class="panel-footer">
						<div class="align-center">
							<button onclick="loadMoreModels(); return false;" class="btn btn-primary btn-sm" id="load_more_btn">
								加载更多
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
$(document).ready( function() {
	$(".collapse").collapse();
});

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

//ajax load more models
function loadMoreModels() {
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
			$(this).hide().fadeIn(1000);
		});
	})
	.fail(function() {
        //if the connection to database failed
        alert("connection to database has failed");
    })
	.always(function() {
        //
    });
}

</script>
@stop