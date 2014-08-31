@extends ('layouts.base')

@section('link-css')
@parent
{{ HTML::style('css/help-page.css'); }}
@stop

@section ('content')
<div id="shihuiduoduo">
	<div id="shihuiduoduo_title">
		{{ HTML::image('images/help/about-product/InfoPage-title-1.png')}}
	</div>
	<div id="shihuiduoduo_element">
		{{ HTML::image('images/help/about-product/InfoPage-elements-1.png')}}	
	</div>		
	{{ HTML::image('images/help/about-product/InfoPage-1bg.png')}}
<div>

@for ($i=0; $i<=5; $i++)
<img src="{{ asset('images/lazyload-holder.png') }}" 
data-original="{{ asset('images/help/InfoPage-'.$i.'.jpg') }}" 
class="lazy">
@endfor
@stop

@section('script')
<script>

$(document).ready(function () {
	$("#shihuiduoduo_element").addClass("shown");
});

$(window).scroll(function (event) {
    var scrollposition = $(window).scrollTop();
    if (scrollposition > $("#shihuiduoduo_element").offset().top - 300){
    	$("#shihuiduoduo_element").addClass("shown");
    }
    // Do something
});
</script>
@stop