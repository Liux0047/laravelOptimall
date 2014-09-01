@extends ('layouts.base')

@section('content')
<div class="container content-container">
	<div class="row">
		<div class="col-md-12">
			{{ HTML::image('images/ambassador/ambassador-illustration.jpg')}}
			{{ Form::open(array('action'=>'AmbassadorController@postCreateAmbassador'))}}
			<div class="align-center">
				{{ Form::submit('立即成为目光之星', array('class'=>'btn btn-primary'))}}
			</div>
			{{ Form::close() }}
		</div><!--End Span6-->
	</div>
</div>
@stop

@section('link-script')
@parent
@stop


@section('script')
@parent
@stop