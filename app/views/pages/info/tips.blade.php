@extends ('layouts.base')

@section('link-css')
@parent
{{ HTML::style('css/info-page.css'); }}
@stop

@section ('content')
<div id="tips-container">
	<div id="" class="container content-container">
		{{ HTML::image('images/info/tips/tips-1.jpg')}}
	</div>
</div>
@stop

@section('script')
@parent
<script>
</script>
@stop