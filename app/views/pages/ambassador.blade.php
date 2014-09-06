@extends ('layouts.base')

@section('content')
<div class="container content-container">	
	<a href="{{ action('MemberAccountController@getAmbassadorPanel') }}">
		{{ HTML::image('images/ambassador/call-to-action.jpg') }}
	</a>

	<!--detailed product info -->
	<ul class="nav nav-tabs ambassador-tabs" role="tablist">
		<li class="active">
			<a href="#about_ambassador"  role="tab" data-toggle="tab">
				什么是目光之星
			</a>
		</li>
		<li>
			<a href="#how_it_works" role="tab" data-toggle="tab">
				活动规则
			</a>
		</li>
		<li>
			<a href="#how_to_earn" role="tab" data-toggle="tab">
				如何返利
			</a>
		</li>
		<li>
			<a href="#terms_condition" role="tab" data-toggle="tab">
				条款协议
			</a>
		</li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane fade in active tab-pane-bordered" id="about_ambassador">

		</div>

		<div class="tab-pane fade tab-pane-bordered" id="how_it_works">
			<div class="row">
				<div class="col-md-12">     
					{{ HTML::image('images/ambassador/ambassador-illustration.jpg') }}
				</div>
			</div>            
		</div>


		<div class="tab-pane fade tab-pane-bordered" id="how_to_earn">

		</div>

		<div class="tab-pane fade tab-pane-bordered" id="terms_condition">
		</div>

	</div>


</div>
@stop

@section('link-script')
@parent
@stop


@section('script')
@parent
<script type="text/javascript">
</script>
@stop