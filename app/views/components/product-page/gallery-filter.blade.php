<div class="gallery-filter-container">

	<div class="panel panel-default">

		<a data-toggle="collapse" href="#style_filters">
			<div class="panel-heading">
				<i class="fa fa-caret-right fa-fw"></i> 风格				
			</div>
		</a>
		<div id="style_filters" class="panel-collapse collapse in">
			<div class="panel-body">
				@foreach($styles as $style)
				<div class="checkbox">
					<label>
						@if(isset($checkedValues['styles']) && in_array($style->product_style_id, $checkedValues['styles']))
						<input type="checkbox" name="styles[]" value="{{ $style->product_style_id }}" onchange="this.form.submit();" checked> 
						@else
						<input type="checkbox" name="styles[]" value="{{ $style->product_style_id }}" onchange="this.form.submit();"> 
						@endif								
						{{ $style->style_name_cn }}
					</label>
				</div>
				@endforeach			
			</div>
		</div>

		<a data-toggle="collapse" href="#color_filters">
			<div class="panel-heading">
				<i class="fa fa-caret-right fa-fw"></i> 颜色				
			</div>
		</a>
		<div id="color_filters" class="panel-collapse collapse @if(isset($checkedValues['colors'])) in @endif">
			<div class="panel-body">
				@foreach($colors as $color)
				<div class="checkbox">
					<label>
						@if(isset($checkedValues['colors']) && in_array($color->product_base_color_id, $checkedValues['colors']))
						<input type="checkbox" name="colors[]" value="{{ $color->product_base_color_id }}" onchange="this.form.submit();" checked>
						@else
						<input type="checkbox" name="colors[]" value="{{ $color->product_base_color_id }}" onchange="this.form.submit();">
						@endif
						{{ HTML::image('images/color/base-color-icons/base-color-'.$color->product_base_color_id.'.png', '', array('class'=>'color-icon')) }}
						{{ $color->base_color_name_cn }}
					</label>
				</div>
				@endforeach			
			</div>
		</div>

		<a data-toggle="collapse" href="#shape_filters">
			<div class="panel-heading">
				<i class="fa fa-caret-right fa-fw"></i> 形状				
			</div>
		</a>
		<div id="shape_filters" class="panel-collapse collapse @if(isset($checkedValues['shapes'])) in @endif">
			<div class="panel-body">
				@foreach($shapes as $shape)
				<div class="checkbox">
					<label>
						@if(isset($checkedValues['shapes']) && in_array($shape->product_shape_id, $checkedValues['shapes']))
						<input type="checkbox" name="shapes[]" value="{{ $shape->product_shape_id }}" onchange="this.form.submit();" checked> 
						@else
						<input type="checkbox" name="shapes[]" value="{{ $shape->product_shape_id }}" onchange="this.form.submit();"> 
						@endif							
						{{ HTML::image('images/shapes/shape-'.$shape->product_shape_id.'.jpg') }}
						{{ $shape->shape_name_cn }}
					</label>
				</div>
				@endforeach			
			</div>
		</div>

		<a data-toggle="collapse" href="#gender_filters">
			<div class="panel-heading">
				<i class="fa fa-caret-right fa-fw"></i> 性别				
			</div>
		</a>
		<div id="gender_filters" class="panel-collapse collapse @if(isset($checkedValues['genders']))) in @endif">
			<div class="panel-body">
				@foreach($genders as $gender)
				<div class="checkbox">
					<label>
						@if(isset($checkedValues['genders']) && in_array($gender->product_gender_id, $checkedValues['genders']))
						<input type="checkbox" name="genders[]" value="{{ $gender->product_gender_id }}" onchange="this.form.submit();" checked> 
						@else
						<input type="checkbox" name="genders[]" value="{{ $gender->product_gender_id }}" onchange="this.form.submit();"> 
						@endif
						{{ $gender->gender_name_cn }}
					</label>
				</div>
				@endforeach		
			</div>
		</div>

		<a data-toggle="collapse" href="#material_filters">
			<div class="panel-heading">
				<i class="fa fa-caret-right fa-fw"></i> 材料				
			</div>
		</a>
		<div id="material_filters" class="panel-collapse collapse @if(isset($checkedValues['materials'])) in @endif">
			<div class="panel-body">
				@foreach($materials as $material)
				<div class="checkbox">
					<label>
						@if(isset($checkedValues['materials']) && in_array($material->product_material_id, $checkedValues['materials']))
						<input type="checkbox" name="materials[]" value="{{ $material->product_material_id }}" onchange="this.form.submit();" checked> 
						@else
						<input type="checkbox" name="materials[]" value="{{ $material->product_material_id }}" onchange="this.form.submit();"> 
						@endif	
						{{ $material->material_name_cn }}
					</label>
				</div>
				@endforeach			
			</div>
		</div>

		<a data-toggle="collapse" href="#frame_filters">
			<div class="panel-heading">
				<i class="fa fa-caret-right fa-fw"></i> 框型				
			</div>
		</a>
		<div id="frame_filters" class="panel-collapse collapse @if(isset($checkedValues['frames'])) in @endif">
			<div class="panel-body">
				@foreach($frames as $frame)
				<div class="checkbox">
					<label>
						@if(isset($checkedValues['frames']) && in_array($frame->product_frame_id, $checkedValues['frames']))
						<input type="checkbox" name="frames[]" value="{{ $frame->product_frame_id }}" onchange="this.form.submit();" checked> 
						@else
						<input type="checkbox" name="frames[]" value="{{ $frame->product_frame_id }}" onchange="this.form.submit();"> 
						@endif								
						{{ $frame->frame_name_cn }}
					</label>
				</div>
				@endforeach			
			</div>
		</div>

	</div>      
</div>
