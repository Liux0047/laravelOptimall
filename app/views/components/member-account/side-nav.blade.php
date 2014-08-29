<div class="col-xs-6 col-sm-2" role="navigation">
    <div class="list-group sidebar">
        <a href="{{ URL::to('member/shopping-history') }}" class="list-group-item @if($entry==1)active @endif">
            <i class="fa fa-book fa-fw fa-lg"></i> 
            已购买的商品
        </a>
        <a href="{{ URL::to('member/security') }}" class="list-group-item @if($entry==2)active @endif">
            <i class="fa fa-gear fa-fw fa-lg"></i> 安全设置
        </a>
        <a href="{{ URL::to('member/my-prescription') }}" class="list-group-item @if($entry==3)active @endif">
            <i class="fa fa-table fa-fw fa-lg"></i> 
            我的验光单
        </a>            
    </div>
</div><!--/span-->
