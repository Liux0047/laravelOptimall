@extends ('layouts.base')


@section('link-css')
@parent
{{ HTML::style('css/info-page.css'); }}
@stop

@section ('content')
<div id="about_prescription">	
	<div class="container img-center">
		<img src="{{ asset(Config::get('optimall.lazyloadImg')) }}" 
		data-original="{{ asset('images/info/about-prescription/about-prescription.jpg') }}" 
		class="lazy img-center">
	</div>
</div>
@stop