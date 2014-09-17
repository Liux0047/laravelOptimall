@extends ('layouts.base')

@section('link-css')
@parent
{{ HTML::style('css/info-page.css'); }}
@stop

@section ('content')
<div id="tips-container">
	<div id="" class="container">
		{{ HTML::image('images/info/tips/tip-2.jpg', '', array('class'=>'img-center'))}}
	</div>
</div>
@stop

@section('script')
@parent
<script>
</script>
@stop