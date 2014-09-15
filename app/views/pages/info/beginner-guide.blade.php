@extends ('layouts.base')

@section ('content')
<div class="">	
	<img src="{{ asset(Config::get('optimall.lazyloadImg')) }}" 
	data-original="{{ asset('images/info/beginner-guide/guide.jpg') }}" 
	class="lazy">
</div>
@stop