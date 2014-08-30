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
						<strong>{{ count($models) }} 结果 </strong>						
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

						<strong>每页显示商品数</strong>        
						<select id="items_per_page" name="items_per_page" class="navbar-select span1" onchange="this.form.submit()">
							@if ($numItemsPerPage == 12)
							<option value="12" selected="true">12</option>
							@else
							<option value="12">12</option>
							@endif
							@if ($numItemsPerPage == 24)
							<option value="24" selected="true">24</option>
							@else
							<option value="24">24</option>
							@endif
							@if ($numItemsPerPage == 36)
							<option value="36" selected="true">36</option>
							@else
							<option value="36">36</option>
							@endif                            
						</select>
					</div>

					<div class="panel-body">
						@foreach ($models as $model)
						@include('components.product-page.product-card', array('model' => $model, 'products' => $products[$model->model_id]))
						@endforeach
					</div>

					<div class="panel-footer">
						{{ $models->links() }}

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

</script>
@stop