<div class="gallery-filter-container">

	<div class="panel panel-default">

		@foreach($filters as $filter)
		<a data-toggle="collapse" href="#{{ $filter['filterName'] }}_filters">
			<div class="panel-heading">
				<i class="fa fa-caret-right fa-fw"></i> {{ $filter['displayName'] }}				
			</div>
		</a>
		<div id="{{ $filter['filterName'] }}_filters" class="panel-collapse collapse @if($filter['filterName']=='styles' || (isset($checkedValues[$filter['filterName']]))) in @endif">
			<div class="panel-body">
				@if(is_array($filterValues[ $filter['filterName'] ]))
				@foreach( $filterValues[ $filter['filterName'] ] as $filterValue )
				<div class="checkbox">
					<label>
						@if(isset($checkedValues[$filter['filterName']]) && in_array($filterValue['option_id'], $checkedValues[$filter['filterName']]))
						<input type="checkbox" name="{{ $filter['filterName'] }}[]" value="{{ $filterValue['option_id'] }}" onchange="this.form.submit();" checked> 
						@else
						<input type="checkbox" name="{{ $filter['filterName'] }}[]" value="{{ $filterValue['option_id'] }}" onchange="this.form.submit();"> 
						@endif				
						@if ($filter['filterName'] == 'colors')
						{{ HTML::image('images/color/base-color-icons/base-color-'.$filterValue['option_id'].'.png', '', array('class'=>'color-icon')) }}
						@elseif ($filter['filterName'] == 'shapes')
						{{ HTML::image('images/shapes/shape-'.$filterValue['option_id'].'.jpg') }}
						@elseif ($filter['filterName'] == 'faces')
						{{ HTML::image('images/faces/face-'.$filterValue['option_id'].'.jpg') }}
						@endif				
						{{ $filterValue['name'] }}
					</label>
				</div>
				@endforeach	
				@endif	
			</div>
		</div>
		@endforeach

	</div>      
</div>
