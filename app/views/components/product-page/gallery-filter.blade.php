<div class="gallery-filter-container">
	<div class="panel panel-metro">
		<div class="panel-heading">优化您的搜索</div>
		<table class="table table-condensed">
			<thead>
			</thead>
			<tbody>
				<tr>
					<th class="active"><span>性别</span></th>
					<td>
						@foreach($genders as $gender)
						<label class="checkbox-inline">
							@if(isset($checkedValues['genders']) && in_array($gender->product_gender_id, $checkedValues['genders']))
							<input type="checkbox" name="genders[]" value="{{ $gender->product_gender_id }}" onchange="this.form.submit();" checked> 
							@else
							<input type="checkbox" name="genders[]" value="{{ $gender->product_gender_id }}" onchange="this.form.submit();"> 
							@endif
							{{ $gender->gender_name_cn }}
						</label>
						@endforeach						
					</td>
				</tr>
				<tr>
					<th class="active"><span>颜色</span></th>
					<td>
						@foreach($colors as $color)
						<label class="checkbox-inline">
							@if(isset($checkedValues['colors']) && in_array($color->product_base_color_id, $checkedValues['colors']))
							<input type="checkbox" name="colors[]" value="{{ $color->product_base_color_id }}" onchange="this.form.submit();" checked>
							@else
							<input type="checkbox" name="colors[]" value="{{ $color->product_base_color_id }}" onchange="this.form.submit();">
							@endif
							{{ $color->base_color_name_cn }}
						</label>
						@endforeach						
					</td>
				</tr>
				<tr>
					<th class="active"><span>形状</span></th>
					<td>
						@foreach($shapes as $shape)
						<label class="checkbox-inline">
							@if(isset($checkedValues['shapes']) && in_array($shape->product_shape_id, $checkedValues['shapes']))
							<input type="checkbox" name="shapes[]" value="{{ $shape->product_shape_id }}" onchange="this.form.submit();" checked> 
							@else
							<input type="checkbox" name="shapes[]" value="{{ $shape->product_shape_id }}" onchange="this.form.submit();"> 
							@endif							
							{{ $shape->shape_name_cn }}
						</label>
						@endforeach						
					</td>
				</tr>
				<tr>
					<th class="active"><span>材料</span></th>
					<td>
						@foreach($materials as $material)
						<label class="checkbox-inline">
							@if(isset($checkedValues['materials']) && in_array($material->product_material_id, $checkedValues['materials']))
							<input type="checkbox" name="materials[]" value="{{ $material->product_material_id }}" onchange="this.form.submit();" checked> 
							@else
							<input type="checkbox" name="materials[]" value="{{ $material->product_material_id }}" onchange="this.form.submit();"> 
							@endif	
							{{ $material->material_name_cn }}
						</label>
						@endforeach						
					</td>
				</tr>
				<tr>
					<th class="active"><span>框型</span></th>
					<td>
						@foreach($frames as $frame)
						<label class="checkbox-inline">
							@if(isset($checkedValues['frames']) && in_array($frame->product_frame_id, $checkedValues['frames']))
							<input type="checkbox" name="frames[]" value="{{ $frame->product_frame_id }}" onchange="this.form.submit();" checked> 
							@else
							<input type="checkbox" name="frames[]" value="{{ $frame->product_frame_id }}" onchange="this.form.submit();"> 
							@endif								
							{{ $frame->frame_name_cn }}
						</label>
						@endforeach						
					</td>
				</tr>
				<tr>
					<th class="active"><span>风格</span></th>
					<td>
						@foreach($styles as $style)
						<label class="checkbox-inline">
							@if(isset($checkedValues['styles']) && in_array($style->product_style_id, $checkedValues['styles']))
							<input type="checkbox" name="styles[]" value="{{ $style->product_style_id }}" onchange="this.form.submit();" checked> 
							@else
							<input type="checkbox" name="styles[]" value="{{ $style->product_style_id }}" onchange="this.form.submit();"> 
							@endif								
							{{ $style->style_name_cn }}
						</label>
						@endforeach						
					</td>
				</tr>
			</tbody>
		</table>
	</div>                       
</div>
