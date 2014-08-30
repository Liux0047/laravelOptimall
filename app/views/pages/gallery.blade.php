@extends ('layouts.base')

@section('link-css')
@parent
{{ HTML::style('plugins/raty-2.7.0/jquery.raty.css') }}
@stop

@section ('content')
<div class="container content-container">
	{{ Form::open(array('action'=>'productController@getGallery', 'method' => 'get')) }}
	<div class="row">
		<div class="shop-items-container">
			<div class="container">
				<div class="panel panel-default" id="options">
					<div class="panel-heading">
						<strong>32 结果</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<strong>排序by</strong> <a class="label label-primary" href="javascript:submitSortOrder('bestSeller');">销量优先</a> |  
						<a href="javascript:submitSortOrder('rating');">评分</a> |  
						<a href="javascript:submitSortOrder('priceHtL');">价格优先：从高到低</a> |  
						<a href="javascript:submitSortOrder('priceLtH');">价格优先：从低到高</a> | 
						<strong>每页显示商品数</strong>        
						<select id="items_per_page" name="itemsPerPage" class="navbar-select span1" onchange="this.form.submit()">
							<option value="12" selected="true">12</option><option value="24">24</option><option value="36">36</option><option value="48">48</option>                                 
						</select>
					</div>

					<div class="panel-body">
						@foreach ($models as $model)
						@include('components.product-page.product-card', array('model' => $model, 'products' => $products[$model->model_id]))
						@endforeach
					</div>

					<div class="panel-footer">
						<div class="align-middle">
							{{ $models->links() }}
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
@stop