<ol class="progtrckr" data-progtrckr-steps="3">
    
    @if ( $progtrckrStep >= 1)
    <li class='progtrckr-done'>
    @else
    <li class='progtrckr-todo'>
    @endif
    选择眼镜及镜片</li>
    
    @if ( $progtrckrStep >= 2)
    <li class='progtrckr-done'>
    @else
    <li class='progtrckr-todo'>
    @endif
    确认订单，填写度数</li>
    
    @if ( $progtrckrStep >= 3)
    <li class='progtrckr-done'>
    @else
    <li class='progtrckr-todo'>
    @endif
    付款</li>
    
</ol>
<br>
