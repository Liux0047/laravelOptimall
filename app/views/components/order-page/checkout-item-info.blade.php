<tr>
	<td class="col-md-4">
		<div class="row">
			<div class="col-md-6">
				{{ HTML::image('images/gallery/'.$item->model.'/'.$item->product.'/medium-view-3.jpg','item picture', array('class' => 'shopping-cart-img')) }}
			</div>
			<div class="col-md-6 shopping-cart-item-info">
				<h4><strong>{{ $item->model_name_cn }}</strong></h4>
				<p>颜色:  
					{{ HTML::image('images/color/color-'.$item->color.'.png') }}
					{{ $item->color_name_cn }} 
					<br>镜片: {{ $item->lens_title_cn }} 
					<br>单价: ¥{{ number_format($item->price, 2) }}
					<br>
				</p>
				<span class="label label-danger">热销</span>
			</div>
		</div>
	</td>
	<td class="col-md-4">       
		@if ($item->is_plano)
		<h5><strong>平光镜 </strong></h5>
		@else
		@include('components.order-page.prescription-table', array( 'prescriptoion' => $item, 'O_S_LEFTNames' => $O_S_LEFTNames,'O_D_RIGHTNames' => $O_D_RIGHTNames,'CommonNames' => $CommonNames)) 
		@endif
	</td>
	<td class="col-md-1">{{ $item->quantity }}</td>
	<td class="col-md-1">
		<span class="shopping-cart-price">¥{{ number_format(($item->price+$item->lens_price)*$item->quantity, 2) }}</span>
	</td>
</tr>