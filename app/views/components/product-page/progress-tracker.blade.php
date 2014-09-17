<ol class="progtrckr" data-progtrckr-steps="3">    
	@if( $progtrckrStep >= 1)<li class='progtrckr-done'>@else<li class='progtrckr-todo'>@endif选择眼镜及镜片</li>@if ( $progtrckrStep >= 2)<li class='progtrckr-done'>@else<li class='progtrckr-todo'>@endif填写验光单</li>@if ( $progtrckrStep >= 3)<li class='progtrckr-done'>@else<li class='progtrckr-todo'>@endif确认订单</li>    
</ol>
