@extends ('layouts.base')

@section ('content')
@for ($i=1; $i<=4; $i++)
<img src="{{ asset('images/lazyload-holder.png') }}" 
data-original="{{ asset('images/help/shopping-'.$i.'.jpg') }}" 
class="lazy">
@endfor
@stop